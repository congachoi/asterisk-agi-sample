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

// Search Code in File (basic search)
$handle = fopen("/var/lib/asterisk/agi-bin/resources/usercodes.txt","r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $pos = strpos($line, $code);
        if ($pos !== false) {
            $codename = substr($line, strpos($line, ',')+1);
            break;
        }
    }
    fclose($handle);
} else {
    $agi->verbose("File not Found or Error", 1);
}

// Set New Variable
$agi->set_variable("CODENAME", $codename);

// Call Verbose App
$agi->verbose("Request for Code : ". $code ." -> ". $codename, 1);

$agi->set_variable("AGIRESULT", "OK");
?>