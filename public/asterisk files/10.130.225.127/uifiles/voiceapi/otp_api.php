<?php
date_default_timezone_set("EST");
# Include DataBase Connection
require "dbConn.php";
$time_stamp = Date('YmdHis');
if (!isset($_REQUEST['campaignid'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 401,
        "desc" => 'Campaign ID Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => ''
    );
    echo json_encode($fail_return);
    exit();
}
$campaignid = filter_input(INPUT_GET, 'campaignid', FILTER_SANITIZE_SPECIAL_CHARS);


# Validate Username
if (!isset($_REQUEST['account'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 402,
        "desc" => 'Account Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
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
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}

# Validate Number
if (!isset($_REQUEST['msisdn'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 405,
        "desc" => 'MSISDN Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}

if (!isset($_REQUEST['otp'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 406,
        "desc" => 'OTP Data Not Passed',
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}

$user_name = mysql_real_escape_string(filter_input(INPUT_GET, 'account', FILTER_SANITIZE_SPECIAL_CHARS));
$password = mysql_real_escape_string(filter_input(INPUT_GET, 'pin', FILTER_SANITIZE_SPECIAL_CHARS));
$msisdn = mysql_real_escape_string(filter_input(INPUT_GET, 'msisdn', FILTER_SANITIZE_SPECIAL_CHARS));
$otp = mysql_real_escape_string(filter_input(INPUT_GET, 'otp', FILTER_SANITIZE_SPECIAL_CHARS));

if (!is_numeric($otp)) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 407,
        "desc" => 'OTP Data Incorrect',
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}

$user_id = auth_user($user_name, $password);
if (!is_numeric($user_id) || $user_id < 1) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 408,
        "desc" => 'Invalid Credentials',
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}
$campaign_arr = Array();
$campaign_arr = get_campaignDetails($user_id, $campaignid);
if (empty($campaign_arr) or !isset($campaign_arr['templateid'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 409,
        "desc" => 'Incorrect Campaign ID',
        "ts" => Date('Y-m-d H;i:s'),
        "campaignid" => $campaignid
    );
    echo json_encode($fail_return);
    exit();
}
formatData($msisdn, $campaignid, $user_id, $campaign_arr['retry'], $campaign_arr['clip_name'], $campaign_arr['templateid'], $otp);
$success_arr = Array(
    "campaignid" => $campaignid,
    "code" => "100",
    "ts" => Date('Y-m-d H:i:s'),
    "status" => "Success"
);
echo (json_encode($success_arr));

function auth_user($user_name, $password) {
    $user_qry = "select userid from users where username='$user_name' and password='$password' and isActive=1 and channel like '%HTTP%' LIMIT 1";
    $res = mysql_query($user_qry);
    $id_arr = mysql_fetch_assoc($res);
    return($id_arr['userid']);
}

function get_campaignDetails($user_id, $campaignid) {
    $camp = Array();
    $camp_qry = "select retry,audio_clip,template_id from campaigns where client_id = '$user_id' and id = $campaignid LIMIT 1";

    $res = mysql_query($camp_qry);
    while ($row = mysql_fetch_assoc($res)) {
        $camp['retry'] = $row['retry'];
        $camp['clip_name'] = $row['audio_clip'];
        $camp['templateid'] = $row['template_id'];
    }
    return $camp;
}

function formatData($msisdn, $camp_id, $user_id, $retry, $clip_name, $template_id, $otp) {
    $clip_name = substr($clip_name, 0, -4) . '.wav';
   // $csv_arr = array_map('str_getcsv', file($csv_uploadPath . $csv_filename));
    $insert_obd_data = "insert into subscribers(msisdn,audio_clip,campid,user_id,retry,sch_time,process_state,template_id, tts) "
            . "values ('$msisdn','$clip_name', $camp_id, $user_id, $retry, NOW(), 3, $template_id, '$otp')";
    mysql_query($insert_obd_data);
    mysql_query("update campaigns set csv_count=csv_count+1 where id = $camp_id");
}
?>

