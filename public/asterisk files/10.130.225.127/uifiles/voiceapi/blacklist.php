<?php
$Allowed_IP_Arr = Array("115.114.108.225","54.251.153.101","54.251.142.5");
if (in_array($_SERVER['REMOTE_ADDR'],$Allowed_IP_Arr)) {
    echo "Accepted";
    
} else {
    die("Sorry You Are Not Authorised To View This Page");
}
?>