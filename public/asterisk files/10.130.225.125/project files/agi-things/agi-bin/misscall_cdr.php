#!/usr/bin/php -q
<?php
require('phpagi.php');
require('mVoice_config.php');
require('mVoice_header.php');
$agi = new AGI();
$header = new header();
$header->dbConnect();
$end_time = Date('Y-m-d H:i:s');
$status = $agi->get_variable("STATUS", true);
if ($status == "SUCCESS") {
    $calling_number = $agi->get_variable("CALLERID(ani)", true);
    $called_number = $agi->get_variable("CALLERID(dnid)", true);
    $start_time = $agi->get_variable("start_time", true);
    $camp_name = $agi->get_variable("CAMPNAME", true);
    $camp_id = $agi->get_variable("CAMPID", true);
    $request_url = $agi->get_variable("ACTIONURL", true);
    $user_id = $agi->get_variable("USERID", true);
    // $request_url = "http://10.130.193.111:8580/pull/MOReceiver?cli=91" . substr($calling_number, -10) . "&msg=CARREFOUR&msisdn=914442941606";
    $agi->verbose("URL::" . $request_url);
    if ($request_url != '') {
        if (strpos($request_url, "?")) {
            $request_url = $request_url . "&" . "cli=91" . substr($calling_number, -10) . "&msisdn=91444294" . $called_number . "&time=$start_time" . "&campaign=$camp_name";
        } else {
            $request_url = $request_url . "?" . "cli=91" . substr($calling_number, -10) . "&msisdn=91444294" . $called_number . "&time=$start_time" . "&campaign=$camp_name";
        }
    }
    $url_result = callURL($request_url);
    $duration = strtotime($end_time) - strtotime($start_time);
    $insert_query = "insert into ibd_mis(calling_number,called_number,start_time,end_time,duration,template,created,user_id,api,camp_id) values ('$calling_number',"
            . "'$called_number','$start_time','$end_time',$duration,'MISSCALL',NOW(),$user_id,'$request_url',$camp_id)";
    mysql_query($insert_query);
} else {
    die();
}

function callURL($request_url, $param = false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return ($data);
}
