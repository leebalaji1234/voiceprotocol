#!/usr/bin/php
<?php
error_reporting(0);
require('phpagi.php');
$agi = new AGI();
$agi->Answer();
$agi->stream_file('hello-world');
$agi->Hangup();
?> 
