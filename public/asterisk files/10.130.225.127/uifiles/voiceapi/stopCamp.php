<?php

# Include DataBase Connection
date_default_timezone_set("EST");
require "dbConn.php";
if (!isset($_REQUEST['camp'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 401,
        "desc" => "No Campaign To Stop!",
        "ts" => Date('Y-m-d H;i:s')
    );
    $json_resp = json_encode($fail_return);
    LogHITinDB($json_resp, 'FAIL');
    die($json_resp);
}
if (!isset($_REQUEST['account'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 402,
        "desc" => 'Account Not Passed',
        "ts" => Date('Y-m-d H;i:s')
    );
    $json_resp = json_encode($fail_return);
    LogHITinDB($json_resp, 'FAIL');
    die($json_resp);
}
# Validate Password
if (!isset($_REQUEST['pin'])) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 403,
        "desc" => 'PIN Not Passed',
        "ts" => Date('Y-m-d H;i:s')
    );
    $json_resp = json_encode($fail_return);
    LogHITinDB($json_resp, 'FAIL');
    die($json_resp);
}
$account = mysql_real_escape_string($_REQUEST['account']);
$pin = mysql_real_escape_string($_REQUEST['pin']);
$camp = mysql_real_escape_string($_REQUEST['camp']);
$camp_info = auth_camp($account, $pin, $camp);
if (!$camp_info) {
    $fail_return = Array(
        "status" => 'failure',
        "code" => 404,
        "desc" => 'Invalid Account/Campaign',
        "ts" => Date('Y-m-d H;i:s')
    );
    $json_resp = json_encode($fail_return);
    LogHITinDB($json_resp, 'FAIL');
    die($json_resp);
}

stopCamp($camp);
$success_return = Array(
    "status" => 'success',
    "code" => 100,
    "desc" => "The Campaign Shall be Stopped",
    "ts" => Date('Y-m-d H;i:s'),
    "camp" => $camp
);
$json_resp = json_encode($success_return);
LogHITinDB($json_resp, 'SUCCESS');
die($json_resp);

function auth_camp($account, $pin, $camp) {
    $chk_camp_query = "Select * from campaigns as c join users as u on u.userid = c.client_id where u.username = '$account' "
            . "and u.password = '$pin' and c.id = $camp";
    $qry_res = mysql_query($chk_camp_query);
    if (mysql_num_rows($qry_res) > 0) {
        return true;
    } else {
        return false;
    }
}

function stopCamp($camp) {
    $insert_qry = "insert into stop_camp_queue(campaign_id,status,created) values('$camp', 0, NOW())";
    mysql_query($insert_qry);
}

function LogHITinDB($json_resp, $status) {
    $insert_qry = "insert into stop_camp_log(response,status,created) values('$json_resp', '$status', NOW())";
    mysql_query($insert_qry);
}

?>