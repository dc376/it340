#!/bin/bash
PATH=$PATH:/sbin:/usr/sbin

###############################
# USAGE / HELP
###############################
usage () {
	echo ""
	echo "Use this script change your Timezone for your Nagios Log Server system. (PHP and Localtime)"
	echo ""
	echo " -z | --zone             	The Posix & PHP supported timezone you want to change to"
	echo "                                  Example Timezone: America/Chicago"
	echo ""
	echo " -h | --help             	Show the help section"
	echo ""
}

###############################
# GET THE VARIABLES
###############################
while [ -n "$1" ]; do
	case "$1" in
		-h | --help)
			usage
			exit 0
			;;
		-z | --zone)
			TZONE=$2
			;;
	esac
	shift
done

if [ "x$TZONE" == "x" ] || [ ! -e /usr/share/zoneinfo/$TZONE ]; then
	echo "You must enter a proper time zone to change to (i.e. America/Chicago)"
	exit 1
fi

# Set the sysconfig clock time
if [ -e /etc/sysconfig/clock ]; then
	echo 'ZONE="'$TZONE'"' > /etc/sysconfig/clock
fi

# Set the localtime
ln -sf /usr/share/zoneinfo/$TZONE /etc/localtime

# Set the PHP timezone
cp -f /etc/php.ini /etc/php.ini.backup
sed -ri "s~^;?date\.timezone *=.*~date.timezone = $TZONE~" /etc/php.ini

# sleep for 2 seconds
sleep 2

# Restart apache and databases to make sure timezone is properly set
if [ ! `command -v systemctl` ]; then
	service httpd restart
	service logstash restart
else
	systemctl restart httpd
	systemctl restart logstash
fi

echo 'All timezone configurations updated to "'$TZONE'"'