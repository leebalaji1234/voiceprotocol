<?php

date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
$log = '/var/log/trans_handler.log';

    require_once dirname(__FILE__) . '/../config.php';
    $config = new config();
    
    if ($config->checkInstance(__FILE__)) {
      
              $stat = "INSERT INTO latency    (date,campaign_id,user_id,Total_calls,Latency15,Latency1630,Latency3160,Latency61120,Latency121180,Latency181300,LatencyGreaterthan300)"
  	. "SELECT DATE(o.call_starttime) AS Dt, o.campaign_id as campaign, o.user_id as userid, COUNT(*) AS TotalCalls,"
	."SUM(IF(TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)<15,1,0)) AS Latency15,"
	."SUM(IF(TIMESTAMPDIFF(SECOND, s.sch_time, o.call_starttime)>15 AND" 
	."TIMESTAMPDIFF(SECOND,s.sch_time, o.call_starttime)<=30,1,0)) AS Latency1630,"  
	."SUM(IF(TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)>30 AND"
	."TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)<=60,1,0)) AS Latency3160,"
	."SUM(IF(TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)>60 AND " 
	."TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)<=120,1,0)) AS Latency61120,"
	."SUM(IF(TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)>120 AND"
	."TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)<=180,1,0)) AS Latency121180,"
	."SUM(IF(TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)>180 AND" 
	."TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)<=300,1,0)) AS Latency181300,"
	."SUM(IF(TIMESTAMPDIFF(SECOND,  s.sch_time, o.call_starttime)>300,1,0)) AS LatencyGreaterThan300"
	."FROM subscribers s JOIN obd_mis o "
	."ON o.`obdrecord_id` = s.`subid` WHERE o.campaign_id = 110 AND o.`retry_count` = 0 "
	."AND DATE(o.call_starttime) = DATE(NOW()) AND HOUR(o.call_starttime) = (HOUR(NOW())-1)");

    $statquery=mysql_query($stat);    

       
    }

?>
  
