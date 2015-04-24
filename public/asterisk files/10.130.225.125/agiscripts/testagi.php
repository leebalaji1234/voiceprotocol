#!/usr/bin/php -q
<?php
require('phpagi.php');
$agi = new AGI();
$agi->answer();
$agi->stream_file('hello-world');
$agi->hangup();
 