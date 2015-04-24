<?php

require_once(dirname(__FILE__) . '/voicefiles.master.config.php');
require_once dirname(__FILE__) . '/../mVoice/config.php';
$config = new config();

class CampaignFileWatcher {

    function __construct() {
        
    }

    function fileReadPushToTable() {

        $get_camp_qry = "select id from campaigns where status = 1 order by id ASC";
        $getRes = mysql_query($get_camp_qry);
        if ($getRes && mysql_num_rows($getRes)) {
            while ($getRow = mysql_fetch_assoc($getRes)) {
                $selQry = "SELECT * FROM voice_file_locations WHERE status = 0 and campaignid = " . $getRow['id'] . " order by id ASC";
                $selRes = mysql_query($selQry);
                if ($selRes && mysql_num_rows($selRes)) {
                    while ($createRow = mysql_fetch_assoc($selRes)) {
                        $campdetail = $this->getCampaignDetail($createRow['campaignid']);
                        $subscribers = "subscribers";
                        $campaign_id = $campdetail['id'];
                        $audio_clip = $campdetail['audio_clip'];
                        $clip_arr = $clip_arr_new = Array();
                        $clip_arr = explode("-$-", $audio_clip);
                        foreach ($clip_arr as $clip_val) {
                            $clip_val_arr = explode('/', $clip_val);
                            $clip_arr_new[] = $clip_val_arr[count($clip_val_arr) - 1];
                        }
                        $audio_clip = join('-$-', $clip_arr_new);
                        $retry = $campdetail['retry'];
                        $isBuffer = $campdetail['isbuffer'];
                        $schedule_time = $campdetail['schedule_time'];
                        $template_id = $campdetail['template_id'];
                        $tts_camp = ($campdetail['tts'] != '') ? $campdetail['tts'] : '';
                        If ($campdetail['usertype'] == 0) {
                            if ($campdetail['rolename'] == 3) {
                                $process_state = 2;
                            } else {
                                $process_state = 1;
                            }
                        } else if ($campdetail['usertype'] == 1) {
                            if ($campdetail['rolename'] == 3) {
                                $process_state = 4;
                            } else {
                                $process_state = 3;
                            }
                        } else {
                            $process_state = 1;
                        }
                        $user_id = $campdetail['client_id'];
                        $interval_json = $campdetail['interval_json'];
                        $callerid = $campdetail['callerid'];
                        $handle = fopen($createRow['location'], "r");
                        $num_arr = $ttsarr = Array();
                        $csv_format = ($createRow['csv_format'] == '') ? 'msisdn' : $createRow['csv_format'];
                        $format_arr = explode("-$-", $csv_format);
                        while ((!feof($handle)) && (($buffer = stream_get_line($handle, 1024, "\n")) !== false)) {
                            $file_arr = $file_content = Array();
                            $tts_str = $num_str = '';
                            $file_arr = explode(",", $buffer);
                            $file_content = array_map('trim', $file_arr);
                            if (count($file_content) >= count($csv_format)) {
                                foreach ($format_arr as $format_key => $format_val) {
                                    if (
                                            $format_val == 'msisdn' && is_numeric($file_content[$format_key]) && $file_content[$format_key] > 0 && strlen($file_content[$format_key]) <= 15
                                    ) {
                                        $num_str = $file_content[$format_key];
                                    } else {
                                        $tts_str = ($tts_str == '') ? $file_content[$format_key] : $tts_str . '-$-' . $file_content[$format_key];
                                    }
                                }
                                if ($num_str != '') {
                                    $num_arr[] = $num_str;
                                    if ($tts_str != '') {
                                        $ttsarr[] = $tts_str;
                                    } else if ($tts_camp != '') {
                                        $ttsarr[] = $tts_camp;
                                    }
                                }
                            }
                        }
                        if (!empty($num_arr)) {
                            $count = count($num_arr);
                            $max_insert = MAX_READ_SPLIT;
                            if ($count <= $max_insert) {
                                $max_insert = $count;
                            }
                            $key_cnt = 0;
                            $no_of_insert = ($count == $max_insert) ? 1 : ceil($count / $max_insert);
                            for ($i = 1; $i <= $no_of_insert; $i++) {
                                $counter = 0;
                                while ($counter < $max_insert && $key_cnt < $count) {
                                    if (!array_key_exists($key_cnt, $ttsarr))
                                        $ttsarr[$key_cnt] = '';
                                    $queryex[] = "('$num_arr[$key_cnt]','$ttsarr[$key_cnt]',NOW(),$campaign_id,'$audio_clip', $isBuffer, $retry, '$schedule_time', "
                                            . "$template_id, $process_state, $user_id, 0, '$interval_json','$callerid')";
                                    $counter++;
                                    $key_cnt++;
                                }
                                mysql_query("INSERT INTO $subscribers(msisdn,tts,created,campid,audio_clip,isbuffer,retry,sch_time,template_id,process_state,
                            user_id,status,interval_json,callerid)
                      VALUES " . implode(",", $queryex));

                                $queryex = Array();
                            }
                            unlink($createRow['location']);
                            mysql_query("update voice_file_locations set status = 1 where id = " . $createRow['id']);
                        } else {
                            mysql_query("update voice_file_locations set status = 99 where id = " . $createRow['id']);
                        }
                    }
                    $cnt_qry = mysql_query("select count(*) as cnt from $subscribers where campid = " . $getRow['id']);
                    $cnt_row = mysql_fetch_assoc($cnt_qry);
                    $cnt = $cnt_row['cnt'];
                    if ($cnt > 0) {
                        mysql_query("update campaigns set status = 2,csv_count = $cnt where id = " . $getRow['id']);
                    } else {
                        mysql_query("update campaigns set status = 99 where id = " . $getRow['id']);
                    }
                } else {
                    mysql_query("update campaigns set status = 99 where id = " . $getRow['id']);
                }
            }
        } else {
            return false;
        }
    }

    function getCampaignDetail($id) {
        if ($id != false && is_numeric($id)) {
            $selQry = "SELECT * FROM campaigns as c join users as u on c.client_id = u.userid WHERE c.id = $id";
            $selRes = mysql_query($selQry);
            if ($selRes && mysql_num_rows($selRes)) {
                $selRow = mysql_fetch_assoc($selRes);
                return $selRow;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

?>