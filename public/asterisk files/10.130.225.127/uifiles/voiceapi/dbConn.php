<?php

$host = "10.130.225.126";
$db_name = "mVoice";
$username = "root";
$password = "ukast*$@!";

//$link = mysql_connect('10.128.80.96', 'voice_sdp', 'Vr5fk#s4T'); // us voice

$link = mysql_connect($host, $username, $password);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($db_name, $link);

?>
