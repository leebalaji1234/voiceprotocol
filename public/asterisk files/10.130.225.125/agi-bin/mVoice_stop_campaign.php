<?php

require('config.php');
require('mVoice_header.php');
$header = new header();
if ($header->checkInstance(__FILE__)) {
    $header->dbConnect();
    $select_camp_query = "select id from campaigns where status = 1";
    $res = mysql_query($select_camp_query);
    while ($row = mysql_fetch_assoc($res)) {
        $campaign_id = $row['id'];
        $select_obd_query = "select count(*) as cnt from subscribers where camp_id = $campaign_id and (status = 0 or status = 1)";
        $res1 = mysql_query($select_obd_query);
        while ($cnt = mysql_fetch_assoc($res1)) {
            if ($cnt['cnt'] == 0) {
                $stop_camp_query = "update campaigns set status = 2 where id = $campaign_id";
                mysql_query($stop_camp_query);
            }
        }
    }
}
?>