#!/usr/bin/php -q
<?php
require_once(__DIR__.'/phpagi/phpagi.php');

// TimeZone
date_default_timezone_set('America/Bogota');

// Execution Timeout
set_time_limit(20);

// New AGI Object 
$agi = new AGI();

// Read Variable "DOCUMENT"
$document = $agi->get_variable("DOCUMENT");
$document = $document["data"];

// Read Variable "Callerid(num)"
$callerid = $agi->get_variable("CALLERID(num)");
$callerid = $callerid["data"];

// Call Verbose App
$agi->verbose("Request for CallerID : ". $callerid ." with Document: ". $document, 1);

// Set New Variables
$agi->set_variable("XCODE", "987654321");
$agi->set_variable("XSTRING", "This is a String.");

$agi->set_variable("AGIRESULT", "OK");
?>