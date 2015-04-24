#!/usr/bin/php -q
<?php
require('phpagi.php');
$agi = new AGI();
$agi->answer();
$agi->stream_file('/home/barumugam/output1');
$agi->hangup();
?>
