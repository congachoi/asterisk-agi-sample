#!/usr/bin/php -q
<?php
require_once(__DIR__.'/phpagi/phpagi.php');

// TimeZone
date_default_timezone_set('America/Bogota');

// Execution Timeout
set_time_limit(20);

// New AGI Object 
$agi = new AGI();

// Read Variable "CODE"
$code = $agi->get_variable("CODE");
$code = $code["data"];

// Name Variable
$codename = "No Found";

// Consume API REST (GET)
// Thank to: jsonplaceholder.typicode.com
$response = file_get_contents('https://jsonplaceholder.typicode.com/users/'.$code);
$restdata = json_decode($response);

// Set New Variable
$agi->set_variable("RESTNAME", $restdata->name);
$agi->set_variable("RESTEMAIL", $restdata->email);

// Call Verbose App
$agi->verbose("Request for Code : ". $code, 1);

$agi->set_variable("AGIRESULT", "OK");
?>