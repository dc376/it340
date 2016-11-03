# /etc/cron.d/nagioslogserver: crontab fragment for nagioslogserver

* * * * * nagios /usr/bin/php -q /var/www/html/nagioslogserver/www/index.php poller > /usr/local/nagioslogserver/var/poller.log 2>&1
* * * * * nagios /usr/bin/php -q /var/www/html/nagioslogserver/www/index.php jobs > /usr/local/nagioslogserver/var/jobs.log 2>&1

