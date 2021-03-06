<?php

# Include DataBase Connection
date_default_timezone_set("EST");
require "dbConn.php";
# Define Audio and CSV Paths
$audio_uploadPath = "/api_audio/";

$wav_path = "/audio_wav/";
# Formatted Date for File Naming
$time_stamp = Date('YmdHis');
# Validate Template ID
if (!isset($_REQUEST['templateid'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 401,
        "desc" => 'Template ID Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
        "templateid" => ''
    );
    echo json_encode($fail_return);
    exit();
}
//$template_id = mysql_real_escape_string(filter_input(INPUT_GET, 'templateid', FILTER_SANITIZE_SPECIAL_CHARS));
$template_id = mysql_real_escape_string($_REQUEST['templateid']);
# Validate Username
if (!isset($_REQUEST['account'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 402,
        "desc" => 'Account Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
        "templateid" => $template_id
    );
    echo json_encode($fail_return);
    exit();
}
# Validate Password
if (!isset($_REQUEST['pin'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 403,
        "desc" => 'PIN Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
        "templateid" => $template_id
    );
    echo json_encode($fail_return);
    exit();
}


/* $user_name = mysql_real_escape_string(filter_input(INPUT_GET, 'account', FILTER_SANITIZE_SPECIAL_CHARS));
  $password = mysql_real_escape_string(filter_input(INPUT_GET, 'pin', FILTER_SANITIZE_SPECIAL_CHARS));
  $retry = (isset($_REQUEST['retry'])) ? filter_input(INPUT_GET, 'retry', FILTER_SANITIZE_SPECIAL_CHARS) : 0; */
$user_name = mysql_real_escape_string($_REQUEST['account']);
$password = mysql_real_escape_string($_REQUEST['pin']);
$interval_json = '';

if (isset($_REQUEST['network_int'])) {
    $network_int = $_REQUEST['network_int'];
    $network_int = interval_check($network_int);
} else {
    $network_int = 1;
}

if (isset($_REQUEST['network_cnt'])) {
    $network_cnt = (int) $_REQUEST['network_cnt'];
    if ($network_cnt < 0 || $network_cnt > 10)
        $network_cnt = 0;
} else {
    $network_cnt = 0;
}

if (isset($_REQUEST['userhangup_int'])) {
    $userhangup_int = $_REQUEST['userhangup_int'];
    $userhangup_int = interval_check($userhangup_int);
} else {
    $userhangup_int = 1;
}

if (isset($_REQUEST['userhangup_cnt'])) {
    $userhangup_cnt = (int) $_REQUEST['userhangup_cnt'];
    if ($userhangup_cnt < 0 || $userhangup_cnt > 3)
        $userhangup_cnt = 0;
} else {
    $userhangup_cnt = 0;
}

if (isset($_REQUEST['userbusy_int'])) {
    $userbusy_int = $_REQUEST['userbusy_int'];
    $userbusy_int = interval_check($userbusy_int);
} else {
    $userbusy_int = 1;
}

if (isset($_REQUEST['userbusy_cnt'])) {
    $userbusy_cnt = (int) $_REQUEST['userbusy_cnt'];
    if ($userbusy_cnt < 0 || $userbusy_cnt > 3)
        $userbusy_cnt = 0;
} else {
    $userbusy_cnt = 0;
}

if (isset($_REQUEST['ringtimeout_int'])) {
    $ringtimeout_int = $_REQUEST['ringtimeout_int'];
    $ringtimeout_int = interval_check($ringtimeout_int);
} else {
    $ringtimeout_int = 1;
}

if (isset($_REQUEST['ringtimeout_cnt'])) {
    $ringtimeout_cnt = (int) $_REQUEST['ringtimeout_cnt'];
    if ($ringtimeout_cnt < 0 || $ringtimeout_cnt > 3)
        $ringtimeout_cnt = 0;
} else {
    $ringtimeout_cnt = 0;
}

if (isset($_REQUEST['retry'])) {
    $retry = $_REQUEST['retry'];
    if (!is_numeric($retry) || $retry > 3 || $retry < 0) {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 408,
            "desc" => 'Retry Value Can only be Numeric Between 0 To 3',
            "ts" => Date('Y-m-d H;i:s'),
            "templateid" => $template_id
        );
        echo json_encode($fail_return);
        exit();
    }
    $interval_arr = Array(
        "network_int" => $network_int,
        "userhangup_int" => $userhangup_int,
        "userbusy_int" => $userbusy_int,
        "ringtimeout_int" => $ringtimeout_int,
        "network_cnt" => $retry,
        "userhangup_cnt" => $retry,
        "userbusy_cnt" => $retry,
        "ringtimeout_cnt" => $retry
    );
    $interval_json = json_encode($interval_arr);
} else {
    $interval_arr = Array(
        "network_int" => $network_int,
        "userhangup_int" => $userhangup_int,
        "userbusy_int" => $userbusy_int,
        "ringtimeout_int" => $ringtimeout_int,
        "network_cnt" => $network_cnt,
        "userhangup_cnt" => $userhangup_cnt,
        "userbusy_cnt" => $userbusy_cnt,
        "ringtimeout_cnt" => $ringtimeout_cnt
    );
    $interval_json = json_encode($interval_arr);
    $retry = 0;
}



if (isset($_REQUEST['callerid']) && is_numeric($_REQUEST['callerid'])) {
    $callerid = $_REQUEST['callerid'];
    if ($callerid == '911' || $callerid == '100') {
        $callerid = '';
    }
} else {
    $callerid = '';
}




$user_info = auth_user($user_name, $password, $template_id);
if (!is_numeric($user_info['user_id']) || $user_info['user_id'] < 1) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 404,
        "desc" => 'Invalid Credentials',
        "ts" => Date('Y-m-d H;i:s'),
        "templateid" => $template_id
    );
    echo json_encode($fail_return);
    exit();
}

if (!array_key_exists("clip_count", $user_info)) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 409,
        "desc" => 'Invalid Template',
        "ts" => Date('Y-m-d H;i:s'),
        "templateid" => $template_id
    );
    echo json_encode($fail_return);
    exit();
}

for ($clip_cnt = 1; $clip_cnt <= $user_info['clip_count']; $clip_cnt++) {
    # Validate Audio File
    if (!isset($_FILES["VC$clip_cnt"]['name'])) {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 405,
            "desc" => 'Audio File Not Passed',
            "ts" => Date('Y-m-d H;i:s'),
            "templateid" => $template_id
        );
        echo json_encode($fail_return);
        exit();
    }

    if (substr($_FILES["VC$clip_cnt"]['name'], -4) != '.mp3' && substr($_FILES["VC$clip_cnt"]['name'], -4) != '.wav') {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 406,
            "desc" => 'Incorrect Audio Format',
            "ts" => Date('Y-m-d H;i:s'),
            "templateid" => $template_id
        );
        echo json_encode($fail_return);
        exit();
    }

    if ($_FILES["VC$clip_cnt"]['size'] <= 0) {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 407,
            "desc" => 'Blank Audio',
            "ts" => Date('Y-m-d H;i:s'),
            "templateid" => $template_id
        );
        echo json_encode($fail_return);
        exit();
    }
}

# Validate Scheduled Time
if (!isset($_REQUEST['sch_time'])) {
    $sch_time = Date('Y-m-d H:i:s');
} else {
    $sch_time = $_REQUEST['sch_time'];
    if (!filter_mydate($sch_time)) {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 410,
            "desc" => 'Incorrect Schedule Time Format',
            "ts" => Date('Y-m-d H:i:s'),
            "templateid" => $template_id
        );
        echo json_encode($fail_return);
        exit();
    }
}


$audio_arr = Array();
for ($clip_cnt = 1; $clip_cnt <= $user_info['clip_count']; $clip_cnt++) {
    $audio_arr[$clip_cnt] = $user_name . '-' . $time_stamp . '-' . $_FILES["VC$clip_cnt"]['name'];
    copy($_FILES["VC$clip_cnt"]['tmp_name'], $audio_uploadPath . $audio_arr[$clip_cnt]);
}
$audio_filename = implode('-$-', $audio_arr);
$campaign_id = get_campaignId($user_info['user_id'], $audio_filename, $time_stamp, $retry, $template_id, $interval_json, $callerid, $sch_time);
formatData($audio_filename, $audio_uploadPath, $wav_path, $campaign_id, $user_info['user_id'], $retry);
$success_return = Array(
    "campaignid" => $campaign_id,
    "code" => 100,
    "ts" => Date('Y-m-d H;i:s'),
    "status" => 'success',
    "templateid" => $template_id
);
echo json_encode($success_return);

function auth_user($user_name, $password, $template_id) {
    $user_qry = "select userid as user_id from users where username='$user_name' and password='$password' and isActive=1 and channel like '%HTTP%' LIMIT 1";
    $res = mysql_query($user_qry);
    $user_id = mysql_fetch_assoc($res);
    $template_qry = "select clip_count from templates where id = $template_id";
    $res1 = mysql_query($template_qry);
    $clip_cnt = mysql_fetch_assoc($res1);
    $user_info['user_id'] = $user_id['user_id'];
    if (mysql_num_rows($res1) > 0) {
        $user_info['clip_count'] = $clip_cnt['clip_count'];
    }
    return $user_info;
}

function get_campaignId($user_id, $clip_name, $time_stamp, $retry, $template_id, $interval_json, $callerid, $sch_time) {
    $camp_name = $time_stamp . Rand(2, 6);
    $insert_campaign_qry = "INSERT INTO campaigns(camp_name,schedule_time,retry,audio_clip,client_id,status,created,template_id,interval_json,callerid) values("
            . "'api-$camp_name','$sch_time',$retry,'$clip_name','$user_id',0,Now(),$template_id,'$interval_json','$callerid')";
    mysql_query($insert_campaign_qry);
    return mysql_insert_id();
}

function formatData($audio_filename, $audio_uploadPath, $wav_path, $camp_id, $user_id, $retry) {
    $clip_arr = explode('-$-', $audio_filename);
    foreach ($clip_arr as $clip_key => $clip_val) {
        $clip_name = substr($clip_val, 0, -4);
        if (substr($clip_val, -4) == '.mp3') {
            shell_exec('/usr/bin/mpg123 -q -w ' . $audio_uploadPath . $clip_name . '.wav' . ' ' . $audio_uploadPath . $clip_val);
            shell_exec('/usr/bin/sox ' . $audio_uploadPath . $clip_name . '.wav' . ' -r 8000 -c 1 -s -2 ' . $wav_path . $clip_name . '.wav');
            shell_exec('rm -rf ' . $audio_uploadPath . $clip_name . '.wav');
        } else {
            shell_exec('/usr/bin/sox ' . $audio_uploadPath . $clip_val . ' -r 8000 -c 1 -s -2 ' . $wav_path . $clip_val);
            shell_exec('rm -rf ' . $audio_uploadPath . $clip_val);
        }
        /*$connection = ssh2_connect('10.130.80.91', 22);
        ssh2_auth_password($connection, 'voice_clip', 'Vo!cecl!p@123');
        $sftp = ssh2_sftp($connection);
        ssh2_scp_send($connection, $wav_path . $clip_name . '.wav', '/upload_audio/' . $clip_name . '.wav', 0755);*/
        $copy_cmd = "/bin/cp $wav_path$clip_name.wav /NFS/$clip_name.wav";
        shell_exec($copy_cmd);
        
    }
}

function interval_check($val_to_check) {
    if (!is_numeric($val_to_check))
        return 5;
    if (strlen((string) $val_to_check) > 0 and strlen((string) $val_to_check) <= 2) {
        return $val_to_check;
    } else
        return 5;
}

function filter_mydate($s) {
    if (preg_match('@^(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)$@', $s, $m) == false) {
        return false;
    }
    if (checkdate($m[2], $m[3], $m[1]) == false || $m[4] >= 24 || $m[5] >= 60 || $m[6] >= 60) {
        return false;
    }
    return true;
}

?>
