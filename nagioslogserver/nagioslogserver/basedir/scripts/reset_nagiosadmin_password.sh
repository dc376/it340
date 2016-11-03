#!/bin/sh
#
# Bash script for resetting the 'nagiosadmin' user password
# Copyright 2014 - Nagios Enterprises LLC
#
# Resets the nagiosadmin user password by replacing the hash in the db.
#

newpass=''

# Display how to use
usage () {
    printf "\n"
    printf "Use this script to reset the nagiosadmin password in Nagios Log Server.\n"
    printf "\n"
    printf " -p | --password		The new nagiosadmin password\n"
    printf "\n"
}

if [ -n "$1" ]; then
	case "$1" in
		-h | --help)
			usage
			exit 0
			;;
		-p | --password)
			newpass=$2
			;;
esac
else
	case "$1" in
		*)
			printf "Enter a new password: \n"
			read -s 'newpass'
			;;
	esac
fi

if [ "$newpass" == '' ]; then
    printf "You must enter a password.\n"
    usage
    exit 1
fi

# Verify that elasticsearch is running
if service elasticsearch status | grep -q 'stopped'; then
    printf "Error: Elasticsearch must be running.\n"
    exit 1
fi

# Create a new password hash
passhash=$(printf "$newpass" | openssl sha256)
passhash=${passhash:9}

update="{\"doc\":{\"password\":\"$passhash\"}}"

# Save new password into elasticsearch
curl -XPOST http://localhost:9200/nagioslogserver/user/1/_update -d "$update" > /dev/null 2>&1
curl -XPOST http://localhost:9200/nagioslogserver/_refresh > /dev/null 2>&1

printf "The password has been set for nagiosadmin user.\n"
