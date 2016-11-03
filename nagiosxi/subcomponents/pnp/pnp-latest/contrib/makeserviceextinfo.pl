#!/usr/bin/perl -w
#
## This program is free software; you can redistribute it and/or
## modify it under the terms of the GNU General Public License
## as published by the Free Software Foundation; either version 2
## of the License, or (at your option) any later version.
##
## This program is distributed in the hope that it will be useful,
## but WITHOUT ANY WARRANTY; without even the implied warranty of
## MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
## GNU General Public License for more details.
##
## You should have received a copy of the GNU General Public License
## along with this program; if not, write to the Free Software
## Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,
#
# $Id: makeserviceextinfo.pl 553 2008-11-07 21:33:50Z Le_Loup $
#

# Nicht als Root ausfuehren
if ($< == 0) {
        print "Don't try this as root \n";
exit 1;
}
	
use strict;
use Getopt::Long;

sub print_help();

my ($status_path, $host_name, $service_description, $serviceext);
my ($opt_v, $opt_h, $PROGNAME);

# hier muessen eventuell die Pfade angepasst werden
$status_path = "/usr/local/nagios/var/objects.cache";
$serviceext = "/usr/local/nagios/etc/pnp-extinfo.cfg";

 
$PROGNAME="makeserviceextinfo.pl";
 
 
Getopt::Long::Configure('bundling');
GetOptions(
        "v"   => \$opt_v, "verbose"     => \$opt_v,
        "h"   => \$opt_h, "help"        => \$opt_h);
 
if ($opt_h) {
        print_help();
        exit 0;
}

print "Starting perfdata scan ....\n";
print "Using $status_path\n";
print "Service Extinfos are written to $serviceext\n";

open (SERVICEEXT, "> $serviceext") or die "Can't write to $serviceext: $!";

# Statusfile einlesen und performance_data=1 suchen
# wenn gefunden den host_namen und die service_description nehmen

open (STATUSDATEI, "< $status_path" ) or die "Can't open $status_path";
SERVICEBEGIN: while (<STATUSDATEI>) {
	next SERVICEBEGIN unless /define service /;

	$host_name = "";
	$service_description = "";

	do {
		$_ = <STATUSDATEI>;
		if ( /^\s*host_name\s*(.*)\s*/) { 
			$host_name = $1;
		}
		
		if (/^\s*service_description\s*(.*)\s*/) {
			$service_description = $1;
		}

		if ( /^\s*process_perf_data\s*0/ ) {
			next SERVICEBEGIN;
		}
	} until ( /\s*}/ or ! $_);

	print "Creating extinfo for Host $host_name Service $service_description\n" if $opt_v;


	# Das schreiben wir jetzt alles in die serviceextinfo.cfg
	print SERVICEEXT <<EOT;

define serviceextinfo {
host_name $host_name
service_description $service_description
notes View PNP graphic
action_url /nagios/pnp/index.php?host=\$HOSTNAME\$&srv=\$SERVICEDESC\$
}

EOT

}
close (STATUSDATEI);
close (SERVICEEXT);
print "Done...\n";


sub print_help () {
        print "\n$PROGNAME creates $serviceext by parsing \n";
	print "$status_path\n\n";
        print "-v enables verbose output\n";
        print "\n";
        print "\n";
}
