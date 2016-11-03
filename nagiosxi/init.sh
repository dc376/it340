#!/bin/bash -e
#
# Sets up the xi-sys.cfg file on full install
#

xivar() {
	./xivar "$1" "$2"
	eval "$1"=\"\$2\"
}

# Add a newline at end of file just in case there isn't one (thanks Git!)
printf "\n" >> xi-sys.cfg

# XI version
xivar xiver $(sed -n '/full/ s/.*=\(.*\)/\L\1/p' ./nagiosxi/basedir/var/xiversion)

# OS-related variables have a detailed long variable, and a more useful short
# one: distro/dist, version/ver, architecture/arch. If in doubt, use the short
. ./get-os-info
xivar distro  "$distro"
xivar version "$version"
xivar ver     "${version%%.*}" # short major version, e.g. "6" instead of "6.2"
xivar architecture "$architecture"

# Set dist variable like before (el5/el6 on both CentOS & Red Hat)
case "$distro" in
	CentOS | RedHatEnterpriseServer | OracleServer )
		xivar dist "el$ver"
		;;
	Fedora )
		xivar dist "fedora$ver"
		;;
	Debian )
		xivar dist "debian$ver"
		;;
	"SUSE LINUX" )
		xivar dist "suse$ver"
		;;
	*)
		xivar dist $(echo "$distro$ver" | tr A-Z a-z)
esac

# i386 is a more useful value than i686 for el5, because repo paths and
# package names use i386
if [ "$dist $architecture" = "el5 i686" ]; then
	xivar arch i386
else
	xivar arch "$architecture"
fi

case "$dist" in
	el5 | el6 | el7 )
		if [ "$arch" = "x86_64" ]; then
			xivar php_extension_dir /usr/lib64/php/modules
		fi
		;;
	suse11 | suse12 )
		if [ "$arch" = "x86_64" ]; then
			xivar php_extension_dir /usr/lib64/php5/extensions
            xivar apacheuser wwwrun
            xivar apachegroup www
            xivar httpdconfdir /etc/apache2/conf.d
            xivar httpdconf /etc/apache2/httpd.conf
            xivar httpdroot /srv/www/htdocs
            xivar phpini /etc/php5/cli/php.ini
            xivar phpconfd /etc/php5/conf.d
            xivar htpasswdbin /usr/bin/htpasswd2
            xivar httpd apache2
            xivar ntpd ntp
            xivar crond cron
            xivar mysqld mysql
		fi
		;;
	ubuntu14 | ubuntu15 | ubuntu16 | debian7 | debian8 )
		if [ "$dist" == "debian7" ]; then
			xivar php_extension_dir /usr/lib/php5/20100525
			xivar httpdconfdir /etc/apache2/conf.d
			xivar mibsdir /usr/share/mibs
		elif [ "$dist" == "ubuntu15" ] || [ "$dist" == "ubuntu16" ] || [ "$dist" == "debian8" ]; then
			xivar php_extension_dir /usr/lib/php5/20131226
			xivar httpdconfdir /etc/apache2/conf-enabled
			xivar mibsdir /usr/share/mibs
		else
			xivar php_extension_dir /usr/lib/php5/20121212
			xivar httpdconfdir /etc/apache2/conf-enabled
		fi
            xivar apacheuser www-data
            xivar apachegroup www-data
            xivar httpdconf /etc/apache2/apache2.conf
            xivar httpdroot /var/www/html
            xivar phpini /etc/php5/apache2/php.ini
            xivar phpconfd /etc/php5/apache2/conf.d
            xivar phpconfdcli /etc/php5/cli/conf.d
			xivar httpd apache2
            xivar ntpd ntp
            xivar crond cron
            xivar mysqld mysql
		;;
    *)
		:
esac

# load xi config if present
if [ -f /usr/local/nagiosxi/html/config.inc.php ]; then
	/usr/bin/php nagiosxi/basedir/scripts/import_xiconfig.php >> xi-sys.cfg
fi

# try and detect an appropriate amount of cores for make -j
procs=2

# most linux and osx
if which getconf &>/dev/null && getconf _NPROCESSORS_ONLN &>/dev/null; then
	procs=$(getconf _NPROCESSORS_ONLN)
else
	# anything with a procfs
	if [ -f /proc/cpuinfo ]; then
		procs=$(cat /proc/cpuinfo | grep processor | wc -l)
		if [ "$procs" == "0" ]; then
			procs=2
		fi
	fi
fi

xivar make_j_flag $procs