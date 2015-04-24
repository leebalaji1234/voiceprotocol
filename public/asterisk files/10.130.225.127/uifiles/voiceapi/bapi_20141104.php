<?php
date_default_timezone_set("EST");
# Include DataBase Connection
require "dbConn.php";
$time_stamp = Date('YmdHis');
$csv_uploadPath = "/api_csv/";
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
if (!isset($_FILES['contactsFile']['name'])) {
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
    if ($message != '1') {
        $message = '0';
    }
} else {
    $message = '0';
}


//$user_name = mysql_real_escape_string(filter_input(INPUT_GET, 'account', FILTER_SANITIZE_SPECIAL_CHARS));
//$password = mysql_real_escape_string(filter_input(INPUT_GET, 'pin', FILTER_SANITIZE_SPECIAL_CHARS));
$user_name = mysql_real_escape_string($_REQUEST['account']);
$password = mysql_real_escape_string($_REQUEST['pin']);
$user_id = Array();
$user_id = auth_user($user_name, $password);
if (!is_numeric($user_id['userid']) || $user_id['userid'] < 1) {
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
$campaign_arr = Array();
$campaign_arr = get_campaignDetails($user_id['userid'], $campaignid);
if (empty($campaign_arr) or ! isset($campaign_arr['templateid'])) {
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



$csv_filename = $user_name . '-' . $time_stamp . '-' . $_FILES['contactsFile']['name'];
copy($_FILES['contactsFile']['tmp_name'], $csv_uploadPath . $csv_filename);
formatData($csv_filename, $csv_uploadPath, $campaignid, $user_id['userid'], $campaign_arr['retry'], $campaign_arr['clip_name'], $campaign_arr['templateid'], $user_id['process_state'], $campaign_arr['agent_number'], $campaign_arr['interval_json'], $campaign_arr['callerid'], $message);
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
        $user_arr['process_state'] = ($user_arr['usertype'] == 0) ? 1 : 3;
    }
    return($user_arr);
}

function get_campaignDetails($user_id, $campaignid) {
    $camp = Array();
    $camp_qry = "select retry,audio_clip,template_id,agent_number,interval_json,callerid from campaigns where (client_id = '$user_id' or client_id in (select userid from users where masterid = '$user_id')) and id = $campaignid LIMIT 1";
//echo $camp_qry;
    $res = mysql_query($camp_qry);
    while ($row = mysql_fetch_assoc($res)) {
        $camp['retry'] = $row['retry'];
        $camp['clip_name'] = $row['audio_clip'];
        $camp['templateid'] = $row['template_id'];
        $camp['agent_number'] = $row['agent_number'];
        $camp['interval_json'] = $row['interval_json'];
        $camp['callerid'] = $row['callerid'];
    }
    return $camp;
}

function formatData($csv_filename, $csv_uploadPath, $camp_id, $user_id, $retry, $clip_name, $template_id, $process_state, $agent_number, $interval_json, $callerid, $message) {
    $csv_count = 0;
    $clip_arr = $clip_new = Array();
    $clip_arr = explode('-$-', $clip_name);
    foreach ($clip_arr as $clip_key => $clip_val) {
        $clip_new[] = substr($clip_val, 0, -4) . '.wav';
    }
    $clip_name_encoded = join('-$-', $clip_new);
    //$clip_name = substr($clip_name, 0, -4);
    $csv_arr = array_map('str_getcsv', file($csv_uploadPath . $csv_filename));
    foreach ($csv_arr as $csv_key => $csv_val) {
        $csv_val[0] = trim($csv_val[0]);
        if (is_numeric($csv_val[0])) {
            $csv_count++;
            $insert_arr[] = "('" .
                    mysql_real_escape_string($csv_val[0]) . "','" .
                    mysql_real_escape_string($clip_name_encoded) . "'," .
                    mysql_real_escape_string($camp_id) . "," .
                    mysql_real_escape_string($user_id) . ",'" .
                    mysql_real_escape_string($agent_number) . "','" .
                    mysql_real_escape_string($interval_json) . "'," .
                    mysql_real_escape_string($retry) . "," .
                    'NOW()' . "," .
                    'NOW()' . "," .
                    mysql_real_escape_string($process_state) . ",'" .
                    mysql_real_escape_string($message) . "','" .
                    mysql_real_escape_string($callerid) . "'," .
                    mysql_real_escape_string($template_id) .
                    ")";
        }
    }
    $insert_obd_data = "insert into subscribers(msisdn,audio_clip,campid,user_id,agent_number,interval_json,retry,sch_time,created,process_state,tts,callerid,template_id) values"
            . implode(',', $insert_arr);
    mysql_query($insert_obd_data);
    mysql_query("update campaigns set csv_count=$csv_count where id = $camp_id");
}

?>
