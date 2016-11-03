#
# libinstall.sh - common functions for installing Nagios software
#

# To use, simply put this file into the same directory as your install file.
# Then add this to the top of your install script:
#     cd $(dirname $(readlink -e "$0"))
#     . ./libinstall.sh
# (The cd command ensures your script is run from the install directory so the
# library can be found, and readlink ensures this works even with symlinks.)
# This library will then automatically run some standard checks for you like
# making sure it's run as root, making sure RHEL systems are registered, etc.
# It will also detect various information about the OS and make that available
# in global variables (see the set_os_info function for the list of variables).
#
# Write your installation steps either as functions or separate scripts. Then
# create a fullinstall function that puts it all together by passing those
# steps to the run_steps wrapper function, which will take care of some error
# handling and progress output. Finally, pass your fullinstall function to the
# log_it wrapper function, which will log the output of the installer to the
# specified file.


# Exit immediately if an untested command fails
set -e

# Global environment variable that determines whether to prompt the user for various information or not
export INTERACTIVE="True"

# Wrapper function for running installation steps
run_steps() {
	local traps
	traps=$(trap)

	for step; do
		# Set trap to print error msg if step fails
		trap "step_error $step" 0

		echo "Running '$step'..."

		if [ -f "installed.$step" ] || [ -f "installed.all" ]; then
			echo "$step step already completed - skipping"

			# Reset traps
			eval "$traps"

			continue
		fi

		"$step"

		echo "$step step completed OK"
		touch "installed.$step"
	done

	# Reset traps
	eval "$traps"

	touch installed.all
	for step; do
		rm -f "installed.$step"
	done
}

# Gets run automatically when an installation step fails
step_error() {
	cat >&2 <<-EOF

		===================
		INSTALLATION ERROR!
		===================
		Installation step failed - exiting.
		Check for error messages in the install log (install.log).

		If you require assistance in resolving the issue, please include install.log
		in your communications with Nagios Enterprises technical support.

		The step that failed was: '$1'
	EOF
}

# Wrapper function for capturing and logging stdout & stderr of another command
# First argument is the log file, followed by the command to run
log_it() {
	log="$1"
	shift
	"$@" 2>&1 | tee -a "$log"
}

# Print installation header text. Takes one argument - the name of the product.
print_header() {
	local product
	product="$1"

	cat <<-EOF

		$product Installation
		$(echo $product Installation | sed 's/./=/g')
		DATE: $(date)
	
		DISTRO INFO:
		$distro
		$version
		$architecture

	EOF
}

# Print installation footer text. Takes two arguments - the name of the product
# and optionally the web server path to the web interface.
print_footer() {
	local product path
	product="$1"
	path="$2"

	echo ""
	echo "$product Installation Success!"
	echo ""

	get_ip
	if [ -n "$path" ]; then
		echo "You can finish the final setup steps for $product by visiting:"
		echo "    http://$ip/$path/"
		echo ""
	fi
}

# Get the IP address of the specified device (or eth0 if none specified)
get_ip() {
	if [ "$dist" == 'el7' ]; then
		ip=$(ip addr | egrep -1 ens[0-9]* | grep -m 1 'inet' | awk '/inet[^6]/{print substr($2,0)}' | sed 's|/.*||')
		if [ "$ip" == '' ]; then
			ip=$(ip addr | egrep -1 eno[0-9]* | grep -m 1 'inet' | awk '/inet[^6]/{print substr($2,0)}' | sed 's|/.*||')
		fi
	else
		ip=$(ifconfig | egrep -1 eth[0-9]* | grep -m 1 'inet' | awk '/inet[^6]/{print substr($2,6)}')
	fi
}

# Convenience function for printing errors and exiting
error() {
	echo "ERROR:" "$@" >&2
	return 1
}

# Return successfully only if the specified RPM packages are installed
is_installed() {
	for pkg; do
		rpm -q "$pkg" &>/dev/null
	done
}

# Adds the specified repo to the system package manager. Can be one of:
#     rpmforge, epel, cr (centos' continuous release repo)
add_yum_repo() {
	local repo url pkg
	repo="$1"

	# See if we need to install the repo...
	if is_installed "$repo-release"; then
		echo "$repo-release RPM installed OK"
		return 0
	fi

	echo "Enabling $repo repo..."

	case "$repo" in
		rpmforge )
			pkg=$(curl -s http://repoforge.org/use/ | grep -o "rpmforge-release-[0-9.-]\+\.$dist\.rf\.$arch\.rpm")
			url="http://pkgs.repoforge.org/rpmforge-release/$pkg"
			;;
		epel )
			pkg="epel-release-latest-$ver.noarch.rpm"
			url="https://assets.nagios.com/epel/$pkg"
			;;
		cr )
			if [ "$dist" = "el6" ] && is_installed centos-release; then
				yum -y install centos-release-cr
			fi
	esac

	if [ -n "$url" ] && [ -n "$pkg" ]; then
		curl -L -O "$url"
		rpm -Uvh "$pkg"
		rm "$pkg"
	fi

	yum check-update || true

	# Check to make sure RPM was installed
	if is_installed "$repo-release"; then
		echo "$repo-release RPM installed OK"
	else
		error "$repo-release RPM was not installed - exiting."
	fi
}

# Adds specified user if it doesn't exist already
add_user() {
	local user
	user="$1"

	if ! grep -q "^$user:" /etc/passwd; then
		case "$dist" in
			el* )
				useradd -n "$user"
				;;
			* )
				useradd "$user"
		esac
	fi
}

# Adds specified group if it doesn't exist already
add_group() {
	local group
	group="$1"

	if ! grep -q "^$group:" /etc/group; then
		groupadd "$group"
	fi
}

# Adds user to the specified groups
add_to_groups() {
	local user
	user="$1"

	shift
	for group; do
		usermod -a -G "$group" "$user"
	done
}

# Prompt the user for a custom MySQL password and sets the mysqlpass variable
get_cluster_info() {
	
	if [ "$ADDING_NODE" = "true" ];then
	
		if [ "x$INTERACTIVE" = "xFalse" -a \( "x$MASTER_IP" = "x" -o "x$CLUSTER_ID" = "x" \) ];then
			error "You must specify another cluster hostname with the -m flag in non-interactive mode"
		fi
		
		echo ""
		echo ""
		
		while [ "x$MASTER_IP" = "x" ]
		do
			read -p "Nagios Log Server Master IP/hostname: " MASTER_IP
			MASTER_IP="${MASTER_IP/[[:space:]]//}"
		done
		while [ "x$CLUSTER_ID" = "x" ]
		do
			read -p "Cluster ID: " CLUSTER_ID
			CLUSTER_ID="${CLUSTER_ID/[[:space:]]//}"
		done
	fi

}

test_cluster_connection() {
	
	if [ "$ADDING_NODE" = "true" ];then
		
		echo ""
		echo ""
		echo "Storing Cluster information..."
		##
		#	While this does work, we are just going to trust they entered them correctly for now
		#	as it could break if they had http blocked on the cluster machine the entered
		##
		
		#	echo "Attempting to connect to active cluster..."
		#		set +e
		#		while [ "x$CLUSTER_SET" = "x" ]
		#		do
		#			
		#			MASTER_RESPONSE=$(curl -s "http://$MASTER_IP/nagioslogserver/index.php/api/backend/_cat/health?h=cl&token=$CLUSTER_ID")
		#			MASTER_RETURN=$?
		#			MASTER_RESPONSE="${MASTER_RESPONSE/[[:space:]]//}"
		#			if [ \( "$MASTER_RETURN" != "0" -o "$MASTER_RESPONSE" = "$CLUSTER_ID" \) -o "$(echo "$MASTER_RESPONSE"|grep -q "Invalid token";echo $?)" = "0" ];then
		#				echo "We could not receive a valid response from the cluster"
		#				unset MASTER_IP CLUSTER_ID
		#				if [ "x$INTERACTIVE" = "xFalse" ];then
		#					error "Could not connect to master"
		#				else
		#					get_cluster_info
		#				fi
		#				
		#			else
		#				curl -s "http://$MASTER_IP/nagioslogserver/index.php/api/backend/_cat/nodes?h=ip&token=$CLUSTER_ID" | sed -e "s/ //g" >> "$backenddir/var/cluster_hosts"
		#				echo "$(cat "$backenddir/var/cluster_hosts" | uniq )" > "$backenddir/var/cluster_hosts"
		#				echo "$CLUSTER_ID" > "$backenddir/var/cluster_uuid"
		#				
		#				CLUSTER_SET="True"
		#			fi
		#		done
		#		set +e
		
		echo "$MASTER_IP" >> "$backenddir/var/cluster_hosts"
		echo "$(cat "$backenddir/var/cluster_hosts" | uniq )" > "$backenddir/var/cluster_hosts"
		echo "$CLUSTER_ID" > "$backenddir/var/cluster_uuid"
	fi
}

# Set the PHP timezone on RHEL-based systems
php_timezone() {
	local ZONE

	# Grab timezone from OS configuration (sets $ZONE)
	if [ "$dist" == "el7" ]; then
		ZONE=$(timedatectl status | sed -n '4p' | sed 's/Timezone: //' | sed 's/(.*)//')
	else
		. /etc/sysconfig/clock
	fi

	# Set timezone if possible
	sed -i "s:^;date\.timezone =$:date.timezone = $ZONE:" "$phpini" || true
}

# Install SourceGuardian PHP extension
install_sourceguardian() {
	local phpver ixedfile entry zipfile

	# Get PHP version
	phpver=$(php -v | head -n 1 | cut -d ' ' -f 2 | cut -d . -f 1,2)

	ixedfile="ixed.$phpver.lin"
	entry="extension=$ixedfile"

	if [ "$arch" = "x86_64" ]; then
		zipfile="sourceguardian/ixed4.lin.x86-64.zip"
	else
		zipfile="sourceguardian/ixed4.lin.x86-32.zip"
	fi

	# Extract SourceGuardian extension to the proper directory
	unzip -o "$zipfile" "$ixedfile" -d "$php_extension_dir"

	if [ -f "$php_extension_dir/$ixedfile" ]; then
		echo "Sourceguardian extension found for PHP version $phpver"
	else
		error "No valid Sourceguardian extension found for PHP" \
			"version $phpver"
	fi

	if grep -q "$entry" "$phpini" "$phpconfd"/*; then
		echo "Sourceguardian extension already in php.ini"
	else
		echo "Adding Sourceguardian extension to php.ini"
		echo "$entry" > "$phpconfd/sourceguardian.ini"
	fi
}

# Send local syslog to standard port
setup_local_syslog() {

	if [ "$dist" == "el5" ]; then
		cat nagioslogserver/logserver.syslog >> /etc/rsyslog.conf
	else
		cp -r nagioslogserver/logserver.syslog /etc/rsyslog.d/nagioslogserver.conf
	fi

	service rsyslog restart
}


# Open the specified TCP ports
open_tcp_ports() {
	local chain rulenum

	if [ "$dist" == "el7" ]; then
		if [ `command -v firewalld` ]; then
			set +e
			for port; do
				firewall-cmd --zone=public --add-port="${port/:/-}"/tcp --permanent
			done
			firewall-cmd --reload
			set -e
		fi
	else
		# determine information for the rules
		chain=$(iptables -L | awk '/^Chain.*INPUT/ {print $2; exit(0)}')
		rulenum=$((`iptables -L $chain | wc -l` - 2))

		# test to make sure we aren't using less than the minimum 1
		if [ $rulenum -lt 1 ]; then rulenum=1; fi

		# add the rules
		for port; do
			iptables -I "$chain" "$rulenum" -m state --state NEW -m tcp \
				-p tcp --dport "$port" -j ACCEPT
		done

		# save changes
		service iptables save
		service iptables restart
	fi
}

# Open the specified UDP ports
open_udp_ports() {
    local chain rulenum

    if [ "$dist" == "el7" ]; then
        if [ `command -v firewalld` ]; then
            set +e
            for port; do
                firewall-cmd --zone=public --add-port="${port/:/-}"/udp --permanent
            done
            firewall-cmd --reload
            set -e
        fi
    else
        # determine information for the rules
        chain=$(iptables -L | awk '/^Chain.*INPUT/ { print $2; exit(0)}')
        rulenum=$((`iptables -L $chain | wc -l` - 2))

        # test to make sure we aren't using less tha n the minimum 1
        if [ $rulenum -lt 1 ]; then rulenum=1; fi

        # add the rules
        for port; do
            iptables -I "$chain" "$rulenum" -m state --state NEW -m udp \
                     -p udp --dport "$port" -j ACCEPT
        done
            
        # save changes
        service iptables save
        service iptables restart
    fi
}


# Disable SELinux on RHEL-based systems
disable_selinux() {
	if selinuxenabled; then
		setenforce 0
		cat >/etc/selinux/config <<-EOF
			# This file controls the state of SELinux on the system.
			# SELINUX= can take one of these three values:
			#     enforcing - SELinux security policy is enforced.
			#     permissive - SELinux prints warnings instead of enforcing.
			#     disabled - No SELinux policy is loaded.
			SELINUX=disabled
			# SELINUXTYPE= can take one of these two values:
			#     targeted - Targeted processes are protected,
			#     mls - Multi Level Security protection.
			SELINUXTYPE=targeted
			# SETLOCALDEFS= Check local definition changes
			SETLOCALDEFS=0
		EOF
	fi
}

# Enable services at boot and make sure it's running
rc() {
	for svc; do
		service "$svc" restart > /dev/null 2>&1 &
		chkconfig --level    35 "$svc" on
		chkconfig --level 01246 "$svc" off
	done
}

# If the system is Red Hat, make sure it's registered & has the appropriate
# channels enabled.
valid_rhel() {
	if [ -x /usr/sbin/rhn_check ] && ! /usr/sbin/rhn_check 2>/dev/null; then
		if [ -x /usr/bin/subscription-manager ] && [[ ! -z $(subscription-manager list | grep Status: | grep -qF Subscribed) ]]; then
			error "your Red Hat installation is not registered or does" \
				  "not have proper entitlements. Please register or" \
				  "enable entitlements at rhn.redhat.com."
		fi
	fi
}

# If the system is Red Hat, make sure it's subscribed to the specified channel.
# The first argument is a regexp to match the channel's label (e.g.
# rhel-.*-server-optional-6). The second argument is a human readable name for
# the channel (e.g. Optional).
has_rhel_channel() {
	if [ "$distro" = "RedHatEnterpriseServer" ] && ! rhn-channel -l | grep -q "$1"; then
		error "please add the '$2' channel to your Red Hat systems" \
			"subscriptions. You can do so in the Red Hat Network" \
			"web interface or by using the rhn-channel command."
	fi
}

# Run some standard checks - root user check, $PATH variable, RHEL validation
std_checks() {
	path_is_ok() {
		echo "$PATH" \
		| awk 'BEGIN{RS=":"} {p[$0]++} END{if (p["/sbin"] && p["/usr/sbin"]) exit(0); exit(1)}'
	}

	if [ $(id -u) -ne 0 ]; then
		error "This script needs to be run as root/superuser."
	fi

	valid_rhel

	if ! path_is_ok; then
		echo "Your system \$PATH does not include /sbin and" \
			"/usr/sbin. This is usually the result of installing" \
			"GNOME rather than creating a clean system."
		echo "Adding /sbin and /usr/sbin to \$PATH."
		PATH="$PATH:/sbin:/usr/sbin"
	fi
	unset -f path_is_ok
}

# Detect OS & set global variables for other commands to use.
# OS variables have a detailed long variable, and a "more useful" short one:
# distro/dist, version/ver, architecture/arch. If in doubt, use the short one.
set_os_info() {
	if [ `uname -s` != "Linux" ]; then
		error "Unsupported OS detected. Can currently only detects" \
			"Linux distributions."
	fi

	if which lsb_release &>/dev/null; then
		distro=`lsb_release -si`
		version=`lsb_release -sr`
	elif [ -r /etc/redhat-release ]; then

		if is_installed centos-release; then
			distro=CentOS
		elif is_installed sl-release; then
			distro=Scientific
		elif is_installed fedora-release; then
			distro=Fedora
		elif is_installed redhat-release || is_installed redhat-release-server; then
			distro=RedHatEnterpriseServer
		fi

		version=`sed 's/.*release \([0-9.]\+\).*/\1/' /etc/redhat-release`

	else
		error "Could not determine OS. Please make sure lsb_release" \
			"is installed."
	fi

	ver="${version%%.*}"

	case "$distro" in
		CentOS | RedHatEnterpriseServer )
			dist="el$ver"
			;;
		Debian )
			dist="debian$ver"
			;;
		* )
			dist=$(echo "$distro$version" | tr A-Z a-z)
	esac

	architecture=`uname -m`

	# i386 is a more useful value than i686 for el5, because repo paths and
	# package names use i386
	if [ "$dist $architecture" = "el5 i686" ]; then
		arch="i386"
	else
		arch="$architecture"
	fi

	httpd='httpd'
	mysqld='mysqld'

	apacheuser='apache'
	apachegroup='apache'
	nagiosuser='nagios'
	nagiosgroup='nagios'
	nagioscmdgroup='nagcmd'

	phpini='/etc/php.ini'
	phpconfd='/etc/php.d'
	php_extension_dir='/usr/lib/php/modules'
	httpdconfdir='/etc/httpd/conf.d'
	mrtgcfg='/etc/mrtg/mrtg.cfg'

	case "$dist" in
		el5 | el6 | el7 )
			if [ "$arch" = "x86_64" ]; then
				php_extension_dir="/usr/lib64/php/modules"
			fi
			;;
		debian6 )
			apacheuser="www-data"
			apachegroup="www-data"
			httpdconfdir="/etc/apache2/conf.d"
			mrtgcfg="/etc/mrtg.cfg"
			phpini="/etc/php5/apache2/php.ini"
			phpconfd="/etc/php5/conf.d"
			php_extension_dir="/usr/lib/php5/20090626"
			httpd="apache2"
			mysqld="mysql"
	esac
}

# Update sudoers file if it hasn't already been updated
sudoers() {
	# Remove old sudoers entries
	grep -v NAGIOSLOGSERVER /etc/sudoers > /etc/sudoers.new
	mv -f /etc/sudoers.new /etc/sudoers

	# Remove TTY requirement
	sed -i 's/Defaults    requiretty/#Defaults    requiretty/g' /etc/sudoers

	# Add new sudoers entries and set permissions
	cat nagioslogserver/nagioslogserver.sudoers >> /etc/sudoers
	chmod 440 /etc/sudoers
}

# Initialize installation - run basic checks and detect OS info
set_os_info
std_checks
