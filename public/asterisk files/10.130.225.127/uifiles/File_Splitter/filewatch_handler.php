<?php

date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
$log = '/var/log/filewatch.log';
$pid = pcntl_fork();
if ($pid == -1) {
    file_put_contents($log, "Error: " . Date('Y-m-d H:i:s') . "Could Not Daemonize Process \n", FILE_APPEND);
    exit();
} else if ($pid) {
    file_put_contents($log, "Info: " . Date('Y-m-d H:i:s') . "Exiting Parent Process \n", FILE_APPEND);
    exit();
} else {
    require_once(dirname(__FILE__) . '/class.filewatcher.php');
    require_once dirname(__FILE__) . '/../mVoice/config.php';
    $config = new config();
    if ($config->checkInstance(__FILE__)) {
        while (true) {
            $objFileWatcher = new CampaignFileWatcher();
            $objFileWatcher->fileReadPushToTable();
            unset($objFileWatcher);
            sleep(1);
        }
    }
}
?>
  
