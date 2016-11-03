#!/bin/bash
#
# Bash script for creating Nagios Log Server backups
# Copyright 2014 - Nagios Enterprises LLC
#
# These backups are used to store the main databases for Nagios Log Server including the kibana
# database, log server's internal database, and log server's internal log database
#

INDEXNAMES=( "nagioslogserver" "kibana-int" "nagioslogserver_log" )
LOGSERVER_DIR="/usr/local/nagioslogserver"
BACKUP_DIR="/store/backups/nagioslogserver"
TIMESTAMP=$(date +%s)
DATE=$(date +%F)

# Create mapping files with the index mapping data
echo "Starting Nagios Log Server Backup"
echo "---------------------------------"
mkdir -p "$BACKUP_DIR/$TIMESTAMP"
chmod 777 "$BACKUP_DIR/$TIMESTAMP"

# Create a backup of each of the indexes and store them in our temp directory
echo -n "Backing up indexes."
echo ""
# Wait for elasticsearch export jobs to finish...
echo "Waiting for backup. This may take a while."
echo ""
cd "$BACKUP_DIR/$TIMESTAMP"
for index in "${INDEXNAMES[@]}"; do
    curl -s -XPOST 'http://localhost:9200/_export/state' > state.json
    count=$(python -m jsonselect.__main__ .count < state.json)
    while [[ $count -gt 0 ]]; do
        echo "Waiting for available slot"
        sleep 1
        curl -s -XPOST 'http://localhost:9200/_export/state' > state.json
        count=$(python -m jsonselect.__main__ .count < state.json)
    done
    echo -n "Backing up $index ..."
    curl -XPOST http://localhost:9200/$index/_export?path=$BACKUP_DIR/$TIMESTAMP/$index.tar.gz > /dev/null 2>&1
    
    count=1
    while [[ $count -gt 0 ]]; do
        echo -n "."
        sleep 1
        curl -s -XPOST 'http://localhost:9200/_export/state' > state.json
        count=$(python -m jsonselect.__main__ .count < state.json)
        
        if [[ $count -gt 0 ]] && [[ $(find $BACKUP_DIR -name "*.tar.gz" -type f | wc -l) -gt 0 ]] && [[ "$(find $BACKUP_DIR -name "*.tar.gz" -type f -mmin -5 | wc -l)" -eq 0 ]];then
            curl -XPUT localhost:9200/_cluster/settings -d '{"transient" : {"plugin.knapsack.export.state" : "[]"}}'
        fi
    done
    echo " Completed."
done


rm -rf state.json
mkdir -p "$BACKUP_DIR/$TIMESTAMP/snapshots"
cp -r $LOGSERVER_DIR/snapshots/*.tar.gz "$BACKUP_DIR/$TIMESTAMP/snapshots/"

# Compress entire directory into a single file
cd $BACKUP_DIR
dirname="nagioslogserver.$DATE.$TIMESTAMP"
mv $TIMESTAMP $dirname
tar czf "$BACKUP_DIR/$dirname.tar.gz" $dirname
chown nagios "$BACKUP_DIR/$dirname.tar.gz"
rm -rf $dirname

echo ""
echo "Backup completed."