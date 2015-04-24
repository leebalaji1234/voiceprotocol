#!/usr/bin/php -q
<?php
require('phpagi.php');
require('mVoice_config.php');
require('mVoice_header.php');
$agi = new AGI();
$header = new header();
$header->dbConnect();
$update_obd = true;
$start_time = $agi->get_variable('start_time', true);
$end_time = Date('Y-m-d H:i:s');
$user_id = $agi->get_variable("user_id", true);
$obdrecord_id = $agi->get_variable("obdrecord_id", true);
$campaign_id = $agi->get_variable('campaign_id', true);
$called_number = $agi->get_variable('no2dial', true);
$agent_number = $agi->get_variable('agent_number', true);
$template_id = $agi->get_variable('template_id', true);
$retry = $agi->get_variable('retry', true);
$retry_count = $agi->get_variable('retry_count', true);
$isChecker = $agi->get_variable('isChecker', true);
$interval_json = $agi->get_variable('interval_json', true);
$id = $agi->get_variable('id', true);
$attempted = $agi->get_variable('attempted', true);
$clips1 = $agi->get_variable("clips1", true);
$clips2 = $agi->get_variable("clips2", true);
$clips3 = $agi->get_variable("clips3", true);
$clips4 = $agi->get_variable("clips4", true);
$clips5 = $agi->get_variable("clips5", true);
$encoded_clips_string = $clips1 . $clips2 . $clips3 . $clips4 . $clips5;
$clips = base64_decode($encoded_clips_string);
$tts = $agi->get_variable("tts", true);
$buffer_status = $agi->get_variable("buffer_status", true);
$call_status = '1';
if ($agi->get_variable('call_status', true) != 'Success') {
    $agi->verbose("call failed");
    $bridge_status = "NA";
    $bridge_duration = "0";
    $id = $agi->get_variable('id', true);
    $duration = 0;
    $status = getdisconnectText($agi->get_variable('REASON', true));
    if ($retry_count < $retry) {
        $call_status = '0';
        $update_obd = false;
        $retry_count++;
        /*$update_node = "update " . TABLENODE . " set status = 0,modified=NOW(),retry_count=retry_count+1 where id = '$id'";
        mysql_query($update_node);*/
        $insert_node = "INSERT INTO promo_retry (no2dial,created,template_id,campaign_id,user_id,clips,obdrecord_id,retry,tts,buffer_status,isChecker,retry_count,agent_number,interval_json,dial_status)
   VALUES ('$called_number',now(),'$template_id','$campaign_id','$user_id','$clips','$obdrecord_id','$retry','$tts','$buffer_status','$isChecker','$retry_count','$agent_number','$interval_json','$status')";
        mysql_query($insert_node);
        $retry_count--;
        $call_status = '0';
    }
} else {
    $duration = strtotime($end_time) - strtotime($start_time);
    $status = 'Success';    
    $bridge_status = $agi->get_variable("DIALSTATUS", true);
    if ($bridge_status == 'ANSWER') {
        $bridge_duration = $agi->get_variable("ANSWEREDTIME", true);
    } else {
        $bridge_duration = 0;
    }
}
$user_keypress = ($duration > 0) ? $agi->get_variable("response_captured", true) : '';
$final_clip = ($duration > 0) ? $agi->get_variable("last_clip", true) : '';
$auth_status = '';
if ($update_obd) {
    $update_obd_query = "update subscribers set process_state = 6 where subid = '$obdrecord_id'";
    mysql_query($update_obd_query);
}
$cdr_query = "INSERT into obd_mis(called_number,campaign_id,obdrecord_id,user_id,template_id,created,call_starttime,"
        . "call_endtime,call_duration,dial_status,retry_count,user_keypress,status,bridge_status,bridge_duration,agent_number) values ('$called_number', $campaign_id,"
        . " $obdrecord_id, $user_id, $template_id, '$attempted', '$start_time', '$end_time', $duration, '$status', $retry_count, '$user_keypress', "
        . "$call_status,'$bridge_status',$bridge_duration,'$agent_number')";
$result = mysql_query($cdr_query);

if ($user_id == 7) {
    
$api_query = "INSERT into callback(called_number,campaign_id,obdrecord_id,user_id,template_id,created,call_starttime,"
        . "call_endtime,call_duration,dial_status,retry_count,user_keypress,last_clip,status,urlstatus,agent_number) values ('$called_number', $campaign_id, $obdrecord_id, "
        . "$user_id, $template_id, '$attempted', '$start_time', '$end_time', $duration, '$status', $retry_count, '$user_keypress', '$final_clip',$call_status,0,'$agent_number')";
$result = mysql_query($api_query);
}


/*if ($user_id == 8) {
$jarulss_api = "http://app.neverskip.com/voicezy_api/vdns.api";
$param_arr = Array(
    "camp_id" => "$campaign_id",
    "destination" => "$called_number",
    "pickup_time" => "$start_time",
    "hangup_time" => "$end_time",
    "retry_cnt" => "$retry_count",
    "reason" => "$status"
);
$params = http_build_query($param_arr);
$header->callURL("$jarulss_api?$params");
} */

function getdisconnectText($reason) {
    switch ($reason) {
        case '0':
            $text = 'Network error';
            break;
        case '1':
            $text = 'User HungUp';
            break;
        case '3':
            $text = 'Ring Timeout';
            break;
        case '5':
            $text = 'User Busy';
            break;
        case '8':
            $text = 'Network Congestion';
            break;
        default:
            $text = 'Network error';
            break;
    }
    return $text;
}
?>