<?php

require_once(dirname(__FILE__) . '/voicefiles.master.config.php');
require_once(dirname(__FILE__) . '/class.chunker.php');
require_once dirname(__FILE__) . '/../mVoice/config.php';
$config = new config();

class CampaignFileProcessor {

    function __construct() {
        
    }

    function fileReadAndSplit() {

        //$selQry = "SELECT * FROM campaigns as c join templates as t on c.template_id = t.id WHERE c.STATUS = 0 AND c.csv_file != '' AND"
          //      . " c.schedule_time > ADDDATE(NOW(), INTERVAL -10 MINUTE) ORDER BY c.id ASC";
        
         $selQry = "SELECT c.id as id,c.csv_file as csv_file,t.csv_format as csv_format FROM campaigns as c join templates as t on c.template_id = t.id "
                 . "WHERE c.STATUS = 0 AND c.csv_file != '' ORDER BY c.id ASC";
         
        $selRes = mysql_query($selQry);
        if ($selRes && mysql_num_rows($selRes)) {            
            while ($selRow = mysql_fetch_assoc($selRes)) {                
                $objChunk = new Chunker();
                if (!empty($selRow['csv_file'])) {
                    $splitUpFile = $objChunk->SplitFile(FILEROOT . $selRow['csv_file'], FILE_SPLIT_LINE_COUNT, $selRow['id'], $selRow['csv_format']);
                }
            }
        } else {
            return false;
        }
    }

}
