<?php

date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
$log = '/var/log/mVoice_click2call_generator.log';
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
        $channel_arr = array();
        $channel_arr = explode(",", BRIDGE_NO_OF_CHANNELS);
        $total_channels = array_sum($channel_arr);
        while (TRUE) {
            if ($header->chkTime(STARTTIME, ENDTIME)) {
                $sleep = 2;

                $get_camp = "SELECT COUNT(*)as cnt,campaign_id FROM promo_node_1 where status = 0 and template_id in (" . BRIDGE . ") GROUP BY 2";
                $camp_res = mysql_query($get_camp);
                $camp_arr = $count_arr = Array();
                while ($row = mysql_fetch_assoc($camp_res)) {
                    $camp_arr[] = $row['campaign_id'];
                    $count_arr[] = $row['cnt'];
                }
                $total_numbers = array_sum($count_arr); // 500
                $camp_arr_cnt = Array();
                $highest = 0;
                $camp_arr_cnt[$highest] = 0;
                Foreach ($camp_arr as $camp_key => $camp_val) {
                    $camp_arr_cnt[$camp_val] = ceil(($count_arr[$camp_key] * $total_channels) / $total_numbers);
                    $highest = ($camp_arr_cnt[$camp_val] > $camp_arr_cnt[$highest]) ? $camp_val : $highest;
                }
                unset($camp_arr_cnt[0]);
                $total_numbers_to_dial = array_sum($camp_arr_cnt);
                if ($total_numbers_to_dial > $total_channels) {
                    $camp_arr_cnt[$highest] = $camp_arr_cnt[$highest] - ($total_numbers_to_dial - $total_channels);
                }
                $query_arr = Array();
                foreach ($camp_arr_cnt as $camp_arr_cnt_key => $camp_arr_cnt_val) {
                    $query_arr[] = '(SELECT * FROM ' . TABLENODE . ' where status = 0 and template_id in (' . BRIDGE . ') and '
                            . 'campaign_id = ' . $camp_arr_cnt_key . ' order by id ASC LIMIT ' . $camp_arr_cnt_val . ')';
                }
                $query = join(' UNION ALL ', $query_arr);


                //$query = 'SELECT * FROM ' . TABLENODE . ' where status = 0 order by id DESC LIMIT 60';
                $result = mysql_query($query);
                while ($arr = mysql_fetch_assoc($result)) {
                    extract($arr);
                    if ($header->checkNumber(substr($no2dial, -10, 10)) != 'Valid') {
                        $cdr_reason = 'Invalid Number';
                        cdr($cdr_reason, $campaign_id, $user_id, $obdrecord_id, $template_id, $no2dial, $id, $isChecker);
                        goto update;
                    }
                    if ($user_id == 7) {
                        $agent_number = "001" . (substr($agent_number, -10, 10));
                    } else {
                        $agent_number = "0" . (substr($agent_number, -10, 10));
                    }
                    if ($user_id == 7) {
                        $no2dial = "001" . (substr($no2dial, -10, 10));
                    } else {
                        $no2dial = "0" . (substr($no2dial, -10, 10));
                    }
                    $attempted = Date('Y-m-d H:i:s');
                    $arr['no2dial'] = $no2dial;
                    $arr['agent_number'] = $agent_number;
                    $file_arr = $header->get_available_filename(CALLFILETEMPDIR, $no2dial, BRIDGE_NO_OF_CHANNELS, BRIDGE_PROMO_SPANS);
                    $filename = $file_arr['file_name'];
                    $span = $file_arr['span'];
                    $clip_arr = explode('-$-', $clips);
                    foreach ($clip_arr as $clipname) {
                        if (!file_exists(PLAYCLIPPATH . '/' . $clipname)) {
                            if (!file_exists(UPLOADCLIPPATH . '/' . $clipname)) {
                                $cdr_reason = 'No Clip';
                                cdr($cdr_reason, $campaign_id, $user_id, $obdrecord_id, $template_id, $no2dial, $id, $isChecker);
                                goto update;
                            } else {
                                $header->createDirectory(dirname(PLAYCLIPPATH . '/' . $clipname));
                                $MixFile = '/usr/bin/sox ' . UPLOADCLIPPATH . '/' . $clipname . ' -r 8000 -c 1 -s -w ' . PLAYCLIPPATH . '/' . $clipname;
                                shell_exec($MixFile);
                            }
                        }
                    }
                    $file = '';
                    
                    foreach ($arr as $key_val => $db_val) {
                        if ($key_val == 'clips') {
                            $encodeurl = base64_encode($db_val);
                            $file .= 'Set: ' . $key_val . '1=' . substr($encodeurl, 0, 230) . "\n";
                            $file .= 'Set: ' . $key_val . '2=' . substr($encodeurl, 230, 230) . "\n";
                            $file .= 'Set: ' . $key_val . '3=' . substr($encodeurl, 460, 230) . "\n";
                            $file .= 'Set: ' . $key_val . '4=' . substr($encodeurl, 690, 230) . "\n";
                            $file .= 'Set: ' . $key_val . '5=' . substr($encodeurl, 920, 230) . "\n";
                        } else
                            $file .= 'Set: ' . $key_val . '=' . $db_val . "\n";
                    }

                    $str = <<<STR
Channel: DAHDI/$span/$agent_number
Context: BRIDGE
Extension: s
Priority: 1
Archive: no
Set: attempted=$attempted                            
$file
STR;

                    file_put_contents($filename, $str);
                    $chgOwner = 'chown asterisk:asterisk ' . $filename;
                    $chgPermission = 'chmod 777 ' . $filename;
                    exec($chgOwner);
                    exec($chgPermission);
                    $command = "mv -f $filename " . CALLFILEDIR;
                    shell_exec($command);
                    mysql_query("delete from " . TABLENODE . " where id = $id");
                    update:
                }
                sleep($sleep);
            } else {
                sleep(20);
            }
        }
    } else {
        die('Another Instance is Already Running');
    }
}

function cdr($cdr_reason, $campaign_id, $user_id, $obdrecord_id, $template_id, $no2dial, $id, $isChecker) {
    global $header;
    $header->dbConnect();


    if ($isChecker == 0) {
        $cdr_query = "INSERT into obd_mis(called_number,campaign_id,obdrecord_id,user_id,template_id,created,call_duration,dial_status,ischecker)"
                . " values ('$no2dial', $campaign_id, $obdrecord_id,$user_id, $template_id, NOW(),0,'$cdr_reason',$isChecker)";
        $update_obd_query = "update subscribers set process_state = 6 where subid = $obdrecord_id";
    } else {
        $cdr_query = "INSERT into obd_mis(called_number,campaign_id,obdrecord_id,user_id,template_id,created,call_duration,dial_status,ischecker,chk_auth_status)"
                . " values ('$no2dial', $campaign_id, $obdrecord_id,$user_id, $template_id, NOW(),0,'$cdr_reason',$isChecker,'Failed')";
        $update_obd_query = "update checkers_log set status = 2,auth_status='Failed',process_update_status=0 where chid = $obdrecord_id";
    }
    $result = mysql_query($cdr_query);
    mysql_query($update_obd_query);
    $update_node_query = "delete from " . TABLENODE . " where id = $id";
    mysql_query($update_node_query);
}

?>
