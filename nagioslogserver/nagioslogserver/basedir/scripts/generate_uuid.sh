#!/bin/sh

usage() {
	cat <<-EOF

		Nagios Log Server UUID generation script
		Copyright 2014, Nagios Enterprises LLC.
		License:
			Nagios Software License <http://assets.nagios.com/licenses/nagios_software_license.txt>

		Usage: $0 -f /full/path/to/file [options...]

		Options:
			-h | --help
				Display this help text
			-f /path/to/file
				file to update
			-o
				Force overwriting of existing file

	EOF
}

# Convenience function for printing errors and exiting
error() {
	echo "ERROR:" "$@" >&2
	exit 1
}

# 
generate_uuid() {
	
	UUIDFILE=$1
	
	if [ ! -f "$UUIDFILE" -o "$OVERWRITE" = "true" ];then
		echo "Generating unique id..."
		if [ `which uuidgen` ]; then
			`which uuidgen` > "$UUIDFILE"
		else
			python -c 'import uuid; print uuid.uuid1()' > "$UUIDFILE"
		fi
		chown nagios.nagios "$UUIDFILE"
		chmod g+w "$UUIDFILE"
	else
		echo "UUID file already exists"
	fi
	
}

if [ "$1" = "" ];then
	usage >&2
	error "Command requires arguments"
fi

while [ -n "$1" ]; do
	case "$1" in
		-h | --help)
			usage
			exit
			;;
		-f )
			UUIDFILE="$2"
			shift
			;;
		-o )
			OVERWRITE="true"
			;;
		* )
			usage >&2
			error "invalid command line syntax."
	esac
	shift
done

generate_uuid $UUIDFILE

