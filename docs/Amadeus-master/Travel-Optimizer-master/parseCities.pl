#!/usr/bin/env perl

use warnings; use strict;
use DBI;
use LWP::Simple;

my $html_string = "";
local $/ = undef;

my $dbh = DBI->connect('dbi:Pg:dbname=lzukdgiw;host=pellefant-02.db.elephantsql.com','lzukdgiw','P3RvimsAf1G_GxCUVwNYGwaKPWSR5Dop',{AutoCommit=>1,RaiseError=>1,PrintError=>0});
#provided by http://www.airportcodes.org/
open FILE, "index.html" or die "Couldn't open file: $!";
$html_string = <FILE>;
close FILE;

my @cities = ( $html_string =~ /.*,*\)/g );
my $name = "";
my $acronym = "";
my @temp = ();
my @items = ();

foreach my $city (@cities) {
	@temp = ($city =~ /.*,/g);
	$name = $temp[0];
	chop($name);

	@temp = ($city =~ /\(.*\)/g);
	$acronym = $temp[0];
	chop($acronym);
	$acronym = reverse($acronym);
	chop($acronym);
	$acronym = reverse($acronym);
	
	@items = ($name, $acronym);
	my $sth = $dbh->prepare("INSERT INTO hack.city (name, acronym) VALUES (?, ?)");
	my $rows = $sth->execute(@items); 
}



