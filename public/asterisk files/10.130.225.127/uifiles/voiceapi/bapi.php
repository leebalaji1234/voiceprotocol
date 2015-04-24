<?php
date_default_timezone_set("EST");
# Include DataBase Connection
require "dbConn.php";
$time_stamp = Date('YmdHis');
$csv_uploadPath = "/var/www/html/mVoice/csv/";
if (!isset($_REQUEST['campaignid'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 401,
        "desc" => 'Campaign ID Not Passed',
        "ts" => Date('Y-m-d H:i:s'),
        "campaignid" => ''
    );
    echo json_encode($fail_return);
    exit();
}
//$campaignid = filter_input(INPUT_GET, 'campaignid', FILTER_SANITIZE_SPECIAL_CHARS);
$campaignid = $_REQUEST['campaignid'];
# Validate Username
if (!isset($_REQUEST['account'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 402,
        "desc" => 'Account Not Passed',
        "ts" => Date('Y-m-d H:i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}
# Validate Password
if (!isset($_REQUEST['pin'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 403,
        "desc" => 'Pin Not Passed',
        "ts" => Date('Y-m-d H:i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}

# Validate Contacts File
if ((!isset($_FILES['contactsFile']['name'])) && (!isset($_REQUEST['msisdn']))) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 404,
        "desc" => 'contactsFile Not Passed',
        "ts" => Date('Y-m-d H:i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}

if (isset($_REQUEST['message']) && is_numeric($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
    if ($message == '1') {
        $update_camp = mysql_query("UPDATE campaigns set tts = 1 where id = $campaignid");
    } else {
        $update_camp = mysql_query("UPDATE campaigns set tts = 0 where id = $campaignid");
        $message = 0;
    }
} else {
    $update_camp = mysql_query("UPDATE campaigns set tts = 0 where id = $campaignid");
    $message = 0;
}
$user_name = mysql_real_escape_string($_REQUEST['account']);
$password = mysql_real_escape_string($_REQUEST['pin']);
$user_id = Array();
$user_id = auth_user($user_name, $password);
$userid = $user_id['userid'];
$usertype = $user_id['usertype'];
if (!is_numeric($userid) || $userid < 1) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 405,
        "desc" => 'Invalid Credentials',
        "ts" => Date('Y-m-d H:i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}
if (isset($_FILES['contactsFile']['name'])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if (substr($_FILES['contactsFile']['name'], -4) != '.csv') {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 406,
            "desc" => 'Incorrect CSV',
            "ts" => Date('Y-m-d H:i:s'),
            "campaignid" => $campaignid
        );
        echo json_encode($fail_return);
        exit();
    }

    if ($_FILES['contactsFile']['size'] <= 0) {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 407,
            "desc" => 'Empty File',
            "ts" => Date('Y-m-d H:i:s'),
            "campaignid" => $campaignid
        );
        echo json_encode($fail_return);
        exit();
    }
}
if (isset($_REQUEST['msisdn'])) {
    $msisdn = mysql_real_escape_string($_REQUEST['msisdn']);
    $msisdn_arr = explode('-$-', $msisdn);
    $cnt_msisdn = count($msisdn_arr);
    if ($cnt_msisdn > 10) {
        $fail_return = Array(
            "status" => 'failure',
            "code" => 409,
            "desc" => 'MSISDN Limit Exceed',
            "ts" => Date('Y-m-d H:i:s'),
            "campaignid" => $campaignid
        );
        echo json_encode($fail_return);
        exit();
    }
}
$campaign_arr = Array();
$campaign_arr = get_campaignDetails($userid, $campaignid);
if (empty($campaign_arr) or ! isset($campaign_arr['template_id'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 408,
        "desc" => 'Incorrect Campaign ID',
        "ts" => Date('Y-m-d H:i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}
$campaign_name = $campaign_arr['camp_name'];
$clip_name = $campaign_arr['audio_clip'];
$retry = $campaign_arr['retry'];
$template_id = $campaign_arr['template_id'];
$schedule_time = $campaign_arr['schedule_time'];

echo $_REQUEST['msisdn']."msisdn";


if (isset($_REQUEST['msisdn'])) {
    if ($usertype == 1) {
        $process_state = 3;
    } else {
        $process_state = 1;
    }
    $clip_new_arr = Array();
    $clip_arr = explode('-$-', $clip_name);
    foreach ($clip_arr as $clip_val) {
        $clip_new_arr[] = substr($clip_val, 0, -4) . '.wav';
    }
    $clips = join('-$-', $clip_new_arr);

    foreach ($msisdn_arr as $msisdn_val) {
        $insert_obd_data = "insert into subscribers(msisdn,audio_clip,campid,user_id,retry,sch_time,process_state,template_id,tts) "
                . "values ('$msisdn_val','$clips', $campaignid, $userid, $retry, '$schedule_time', $process_state, $template_id, '$message')";
        mysql_query($insert_obd_data);
    }
    mysql_query("update campaigns set csv_count=csv_count+$cnt_msisdn where id = $camp_id");
}
if (isset($_FILES['contactsFile']['name'])) {
    $csv_filename = $user_name . '-' . $time_stamp . '-' . $_FILES['contactsFile']['name'];
    if (!is_dir($csv_uploadPath . $userid)) {
        createDirectory($csv_uploadPath . $userid);
    }
    $csv_uploadPath = $csv_uploadPath . $userid;
    copy($_FILES['contactsFile']['tmp_name'], $csv_uploadPath . '/' . $csv_filename);
    update_campaign('csv/' . $userid . '/' . $csv_filename, $campaignid);
}
$success_arr = Array(
    "campaignid" => $campaignid,
    "code" => "100",
    "ts" => Date('Y-m-d H:i:s'),
    "status" => "Success"
);
echo (json_encode($success_arr));

function auth_user($user_name, $password) {
    $user_qry = "select userid,usertype from users where username='$user_name' and password='$password' and isActive=1 and channel like '%HTTP%' LIMIT 1";
    $res = mysql_query($user_qry);
    while ($row = mysql_fetch_assoc($res)) {
        $user_arr['userid'] = $row['userid'];
        $user_arr['usertype'] = $row['usertype'];
    }
    return($user_arr);
}

function get_campaignDetails($user_id, $campaignid) {
    $camp = Array();
    $camp_qry = "select retry,audio_clip,template_id,agent_number,interval_json,callerid from campaigns where (client_id = '$user_id' or client_id in (select userid from users where masterid = '$user_id')) and id = $campaignid LIMIT 1";
//echo $camp_qry;
    $res = mysql_query($camp_qry);
    while ($row = mysql_fetch_assoc($res)) {
        $camp['id'] = $row['id'];
        $camp['retry'] = $row['retry'];
        $camp['audio_clip'] = $row['audio_clip'];
        $camp['template_id'] = $row['template_id'];
        $camp['interval_json'] = $row['interval_json'];
        $camp['callerid'] = $row['callerid'];
        $camp['schedule_time'] = $row['schedule_time'];
    }
    return $camp;
}

function update_campaign($csv_name, $si_campid) {
    $up_query = "update campaigns set csv_file = '$csv_name',status = 0 where id = $si_campid";
    $up_res = mysql_query($up_query);
}

function createDirectory($dir2create) {
    $dir = '';
    $dirarr = explode('/', $dir2create);
    foreach ($dirarr as $key => $value) {
        $dir = $dir . '/' . $value;
        if (!is_dir($dir))
            mkdir($dir);
    }
}

?>
