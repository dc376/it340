#!/bin/perl
my @input=<STDIN>;
foreach $line(@input){
        $line =~ /<(NAGIOS_[A-Z 0-9]+)>(.*)<\/NAGIOS_.*>/ ;
        $ENV{$1}=$2;
}
system( '/usr/local/nagios/libexec/process_perfdata.pl');
exit 0;

