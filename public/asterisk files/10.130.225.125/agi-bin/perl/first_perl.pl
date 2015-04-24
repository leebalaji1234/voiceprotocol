#!/usr/bin/perl
use strict;
$|=1;
my %AGI; my $tests=0; my $fail=0; my $pass=0;
while(<STDIN>) {
        chomp;
        last unless length($_);
        if (/^agi_(\w+)\:\s+(.*)$/) {
                $AGI{$1} = $2;
        }
}

print STDERR "AGI Environment Dump:\n";
foreach my $i (sort keys %AGI) {
        print STDERR " -- $i = $AGI{$i}\n";
}


