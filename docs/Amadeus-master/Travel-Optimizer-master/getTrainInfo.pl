#!/usr/bin/env perl

use warnings; use strict;
use JSON::Parse 'parse_json';
use DBI;
use LWP::Simple;

my $dbh = DBI->connect('dbi:Pg:dbname=lzukdgiw;host=pellefant-02.db.elephantsql.com','lzukdgiw','P3RvimsAf1G_GxCUVwNYGwaKPWSR5Dop',{AutoCommit=>1,RaiseError=>1,PrintError=>0});

my $char = 'a';
my $apiUrlStart = 'http://api.sandbox.amadeus.com/v1.2/rail-stations/autocomplete?term=';
my $apiUrlEnd = '&apikey=bnRwWHdSaSXJMLKtMljloLFf7f6oYlIo';
my $url = '';
my $json = undef;
my @items = ();

for (my $i=0; $i < 26; ++$i){
	$json = get $apiUrlStart.$char.$apiUrlEnd;	
	++$char;
	my @parsed = parse_json($json);
	foreach my $j ($parsed[0])
	{
		foreach my $k (@$j){
			@items = ($k->{label}, $k->{value});
			my $sth = $dbh->prepare("INSERT INTO hack.train_info (name, station_id) VALUES (?, ?)");
			my $rows = $sth->execute(@items);
		}
		
	}
}



