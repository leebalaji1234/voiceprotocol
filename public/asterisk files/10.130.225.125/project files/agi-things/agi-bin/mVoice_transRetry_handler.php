<?php
error_reporting(0);
$log = '/var/log/mVoice_transRetry.log';
$pid = pcntl_fork();
if ($pid == -1) {
    file_put_contents($log, "Error: " . Date('Y-m-d H:i:s') . "Could Not Daemonize Process \n", FILE_APPEND);
    exit();
} else if ($pid) {
    file_put_contents($log, "Info: " . Date('Y-m-d H:i:s') . "Exiting Parent Process \n", FILE_APPEND);
    exit();
} else {
    require('mVoice_header.php');
    require('mVoice_config.php');
    $header = new header();
    if ($header->checkInstance(__FILE__)) {
        $header->dbConnect();
        while (TRUE) {
            $get_retry_query = "select * from trans_retry_1 where status = 0 and campaign_id not in "
                    . "(select campaign_id from stop_camp_queue) order by id ASC limit 1000";
            $result = mysql_query($get_retry_query);
            while ($data_arr = mysql_fetch_assoc($result)) {
                extract($data_arr);
                $insert_flag = false;
                $create_time = strtotime($created);
                $now_time = strtotime(Date('Y-m-d H:i:s'));
                $interval = $now_time - $create_time;
                if ($interval_json == '') {
                    if ($interval >= 60) {
                        $insert_flag = true;
                    }
                } else {
                    $interval_arr = json_decode($interval_json, true);
                    switch ($dial_status) {
                        case "Network error" :
                            if ($interval >= $interval_arr['network_int']*60)
                                $insert_flag = true;
                            break;
                        case "User HungUp" :
                            if ($interval >= $interval_arr['userhangup_int']*60)
                                $insert_flag = true;
                            break;
                        case "Ring Timeout" :
                            if ($interval >= $interval_arr['ringtimeout_int']*60)
                                $insert_flag = true;
                            break;
                        case "User Busy" :
                            if ($interval >= $interval_arr['userbusy_int']*60)
                                $insert_flag = true;
                            break;
                        case "Network Congestion" :
                            if ($interval >= $interval_arr['network_int']*60)
                                $insert_flag = true;
                            break;
                        default :
                            if ($interval >= 60)
                                $insert_flag = true;
                            break;
                    }
                }
                if ($insert_flag) {
                    $insert_query = "INSERT INTO trans_node_1 (no2dial,created,template_id,campaign_id,user_id,clips,obdrecord_id,retry,tts,isChecker,retry_count,interval_json,agent_number,callerid)
   VALUES ('$no2dial',now(),'$template_id','$campaign_id','$user_id','$clips','$obdrecord_id','$retry','$tts','$isChecker','$retry_count','$interval_json','$agent_number','$callerid')";
                    $delete_query = "delete from trans_retry_1 where id = $id";
                    mysql_query($insert_query);
                    mysql_query($delete_query);
                }
            }
           /* $update_stopped = "update stop_camp_queue set status = 2 where status = 1";
            mysql_query($update_stopped);*/
            sleep(2);
        }
    }
}