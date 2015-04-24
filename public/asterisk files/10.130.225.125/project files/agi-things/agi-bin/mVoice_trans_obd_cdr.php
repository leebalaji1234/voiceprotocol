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
$callerid = $agi->get_variable('callerid', true);
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
$duration = strtotime($end_time) - strtotime($start_time);
if (($agi->get_variable('call_status', true) != 'Success' && $agi->get_variable('call_status', true) != 'Machine Detected') || $duration == 0) {   
    $duration = 0;
    $status = getdisconnectText($agi->get_variable('REASON', true));
    $retry_cond = false;
    if ($interval_json == '') {
        if ($retry_count < $retry) {
            $retry_cond  = true;
        }
    } else {
        $interval_arr = json_decode($interval_json, true);
        switch ($status) {
            case "Network error" :
                if ($retry_count < $interval_arr['network_cnt'])
                    $retry_cond = true;
                break;
            case "User HungUp" :
                if ($retry_count < $interval_arr['userhangup_cnt'])
                    $retry_cond = true;
                break;
            case "Ring Timeout" :
                if ($retry_count < $interval_arr['ringtimeout_cnt'])
                    $retry_cond = true;
                break;
            case "User Busy" :
                if ($retry_count < $interval_arr['userbusy_cnt'])
                    $retry_cond = true;
                break;
            case "Network Congestion" :
                if ($retry_count < $interval_arr['network_cnt'])
                    $retry_cond = true;
                break;
            default :
                if ($retry_count < $interval_arr['network_cnt'])
                    $retry_cond = true;
                break;
        }
    }
    
    
    if($retry_cond) {
        $call_status = '0';
        $update_obd = false;
       /* $update_node = "update " . TRANS_TABLENODE . " set status = 0,modified=NOW(),retry_count=retry_count+1 where id = $id";
        mysql_query($update_node);*/
        $retry_count++;
        $insert_node = "INSERT INTO trans_retry_1 (no2dial,created,template_id,campaign_id,user_id,clips,obdrecord_id,retry,tts,isChecker,retry_count,interval_json,dial_status,callerid,status)
   VALUES ('$called_number',now(),'$template_id','$campaign_id','$user_id','$clips','$obdrecord_id','$retry','$tts','$isChecker','$retry_count','$interval_json','$status','$callerid',0)";
        mysql_query($insert_node);
        $retry_count--;
        
        
    }
} else {
    
    $status = $agi->get_variable('call_status', true);
}
$user_keypress = ($duration > 0) ? $agi->get_variable("response_captured", true) : '';
$final_clip = ($duration > 0) ? $agi->get_variable("last_clip", true) : '';
$auth_status = '';
if ($update_obd) {
    if ($isChecker == 0) {
    $update_obd_query = "update subscribers set process_state = 6 where subid = $obdrecord_id";
    } else {
        $keypress_arr = explode('::', $user_keypress);
        if (in_array(CHECKER_AKP, $keypress_arr)) {
            $auth_status = "Approved";
        } else if (in_array(CHECKER_RKP, $keypress_arr)) {
            $auth_status = "Rejected";
        } else {
            $auth_status = "Failed";
        }
        $update_obd_query = "update checkers_log set status = 2,auth_status = '$auth_status',process_update_status=0 where chid = $obdrecord_id";
    }
    mysql_query($update_obd_query);
   /* $update_node_query = "update " . TRANS_TABLENODE . " set status = 2,modified=NOW() where id = $id";
    mysql_query($update_node_query); */
}
$cdr_query = "INSERT into obd_mis(called_number,campaign_id,obdrecord_id,user_id,template_id,created,call_starttime,"
        . "call_endtime,call_duration,dial_status,retry_count,user_keypress,last_clip,ischecker,status,chk_auth_status) values ('$called_number', $campaign_id, $obdrecord_id, "
        . "$user_id, $template_id, '$attempted', '$start_time', '$end_time', $duration, '$status', $retry_count, '$user_keypress', '$final_clip',$isChecker,$call_status,'$auth_status')";
$result = mysql_query($cdr_query);

if ($user_id == 7) {
$api_query = "INSERT into callback(called_number,campaign_id,obdrecord_id,user_id,template_id,created,call_starttime,"
        . "call_endtime,call_duration,dial_status,retry_count,user_keypress,last_clip,status,urlstatus) values ('$called_number', $campaign_id, $obdrecord_id, "
        . "$user_id, $template_id, '$attempted', '$start_time', '$end_time', $duration, '$status', $retry_count, '$user_keypress', '$final_clip',$call_status,0)";
$result = mysql_query($api_query);
}
/*
if ($user_id == 8) {
$agi->verbose("JARULSS API CALL");
$jarulss_api = "http://app.neverskip.com/voicezy_api/vdns.api";
//$test_api = "10.20.52.45/test.php";
$param_arr = Array(
    "camp_id" => "$campaign_id",
    "destination" => "$called_number",
    "pickup_time" => "$start_time",
    "hangup_time" => "$end_time",
    "retry_cnt" => "$retry_count",
    "reason" => "$status"
);
$params = http_build_query($param_arr);
$agi->verbose("API PARAMS::$jarulss_api?$params");
$url_resp = $header->callURL("$jarulss_api?$params");
$agi->verbose("URL RESP::$url_resp");
//$url_resp1 = $header->callURL("$test_api?$params");
//$agi->verbose("URL RESP::$url_resp1");
} */

function getdisconnectText($reason) {
    switch ($reason) {
        case '0':
            $text = 'Network error';
            break;
        case '1':
            $text = 'Hung Up';
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
