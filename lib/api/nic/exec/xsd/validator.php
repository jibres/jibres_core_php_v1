#!/usr/bin/env php
<?php
# vim: set autoindent tabstop=8 softtabstop=4 expandtab shiftwidth=4

if (count($argv) != 3)
{
    print "Usage: {$argv[0]} <schema-file> <data-file>\n";
    exit(128);
}

$schema_file = $argv[1];
$data_file = $argv[2];

$dom = new DOMDocument();
$dom->load($data_file);
$v = $dom->schemaValidate($schema_file);

if ($v) {
    print "$schema_file: $data_file is Valid.\n";
    exit(0);
}
else {
    print "$schema_file: $data_file is NOT VALID!\n";
    exit(1);
}

