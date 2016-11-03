#!/bin/sh
#
# Bash script for restoring Nagios Log Server backups
# Copyright (c) 2014-2015 Nagios Enterprises, LLC. All rights reserved.
#
# Restores the backups created for the 3 internal Nagios Log Server databases
#

INDEXNAMES=( "nagioslogserver" "kibana-int" "nagioslogserver_log" )
LOGSERVER_DIR="/usr/local/nagioslogserver"
BACKUP_DIR="/store/backups/nagioslogserver"

if [ -z "$1" ];then
    echo "Backup file must be specified as the first argument"
    echo "e.g. ./$0 backup_name.tar.gz"
    exit 1
fi

# Restoring mapping files with the index mapping data
echo "Starting Nagios Log Server Restore"
echo "----------------------------------"

filename=$1
if [[ $filename != *.tar.gz ]]; then
    filename="$filename.tar.gz"
fi
folder=${filename:0:${#filename}-7}
echo "full folder is $folder"
# Extract the file given and start the actual updating
echo "Extracting the backups."
cd $BACKUP_DIR
tar xf $filename
cd $folder

# Loop through all the indexes and restore them one by one
echo -n "Creating restore jobs for indexes... "
for index in "${INDEXNAMES[@]}"; do
    curl -s -XPOST 'http://localhost:9200/_import/state' > state.json
    count=$(python -m jsonselect.__main__ .count < state.json)
    while [[ $count -gt 0 ]]; do
        echo "Waiting for available slot"
        sleep 1
        curl -s -XPOST 'http://localhost:9200/_import/state' > state.json
        count=$(python -m jsonselect.__main__ .count < state.json)
    done
    echo -n "Restoring$index ... "
    # Delete and restore the index
    if [ -f "$folder/$index.tar.gz" ]; then
        # Delete index
        curl -XDELETE "http://localhost:9200/$index/" > /dev/null 2>&1

        # Restore the index by importing the index tar.gz
        curl -XPOST "http://localhost:9200/$index/_import?path=$folder/$index.tar.gz" > /dev/null 2>&1
    else
        printf "\n\n ERROR: Backup file $filename was not found\n"
        exit 1
    fi
    
    count=1
    while [[ $count -gt 0 ]]; do
        echo -n "."
        sleep 1
        curl -s -XPOST 'http://localhost:9200/_import/state' > state.json
        count=$(python -m jsonselect.__main__ .count < state.json)
    done
    
done
echo "Completed."

# Restore snapshots
cp -r $folder/snapshots/*.tar.gz $LOGSERVER_DIR/snapshots
chown nagios.nagios -R $LOGSERVER_DIR/snapshots

# Apply new configuration of ES
php /var/www/html/nagioslogserver/www/index.php configure apply_to_instances

# Clean up
rm -rf "$folder"

echo ""
echo "Restore Complete!"
