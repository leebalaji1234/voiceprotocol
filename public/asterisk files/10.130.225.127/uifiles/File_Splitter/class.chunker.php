<?php

require_once dirname(__FILE__) . '/../mVoice/config.php';
$config = new config();

class Chunker {
    private $LogdirectoryPath = '/var/log/chunker.log';

    function __construct() {
        
    }

    function fputcsv(&$handle, $fields = array()) {
        foreach ($fields as $value) {
            $value_str = implode(',', $value);
            fwrite($handle, $value_str . "\n");
        }
    }

    function SplitFile($file, $lines, $campaignid, $csv_format) {

        if (!file_exists($file)) {
            mysql_query("update campaigns set status = 99 where id = $campaignid");
            file_put_contents($this->LogdirectoryPath, "Error: " . Date('Y-m-d H:i:s') . "File not Present - $file -- CampID: $campaignid  \n", FILE_APPEND);
            return false;
        }
        $createdirectory = "/tmp/$campaignid/" . mt_rand(1000, 9999);
        $this->createDirectory($createdirectory);
        $fileName = time() . '_' . mt_rand(1000, 9999);
        $splitFiles = $createdirectory . '/' . $fileName;

        try {
            shell_exec("split -d -l $lines $file $splitFiles");
            exec("ls $createdirectory | grep $fileName", $output_arr);
            if ($output_arr) {
                $chunkFileName = Array();
                foreach ($output_arr as $file_key => $file_name) {
                    $processed_file = false;
                    $processed_file = $this->ProcessFile($createdirectory . '/', $file_name, $campaignid);
                    if ($processed_file) {
                        $chunkFileName[] = $processed_file;
                    }
                }
                if (!empty($chunkFileName)) {
                    $count = count($chunkFileName);
                    $max_insert = MAX_QRY_INSERT;
                    if ($count <= $max_insert) {
                        $max_insert = $count;
                    }
                    $key_cnt = 0;
                    $no_of_insert = ($count == $max_insert) ? 1 : ceil($count / $max_insert);
                    for ($i = 1; $i <= $no_of_insert; $i++) {
                        $counter = 0;
                        while ($counter < $max_insert && $key_cnt < $count) {
                            $fullPath = $chunkFileName[$key_cnt];
                            $queryex[] = "('$fullPath','$campaignid',now(),'$csv_format')";
                            $counter++;
                            $key_cnt++;
                        }
                        $takeRes = mysql_query("INSERT INTO voice_file_locations(location,campaignid,created,csv_format)
		   VALUES " . implode(",", $queryex));
                        $queryex = Array();
                    }
                    mysql_query("update campaigns set status = 1 where id = $campaignid");
                    return true;
                } else {
                    mysql_query("update campaigns set status = 99 where id = $campaignid");
                    return false;
                }
            } else {
                mysql_query("update campaigns set status = 99 where id = $campaignid");
                return false;
            }
        } catch (Exception $e) {
            mysql_query("update campaigns set status = 99 where id = $campaignid");
            file_put_contents($this->LogdirectoryPath, "Error: " . Date('Y-m-d H:i:s') . "while on split " . $e->getMessage() . "  \n", FILE_APPEND);
            return false;
        }
    }

    function ProcessFile($full_path, $file, $campaignid) {
        try {
            $handle = fopen($full_path . $file, "r");
            $file_content = array();
            $mod_files = false;
            while ((!feof($handle)) && (($buffer = stream_get_line($handle, filesize($full_path . $file), "\n")) !== false)) {
                $file_arr = explode(',', $buffer);
                $file_content[] = array_map('trim', $file_arr);
            }
            if (!empty($file_content)) {
                $mod_files = $full_path . strrev($file);
                $upload_data_file = fopen($mod_files, 'w');
                $numarr = array_map('trim', $numarr);
                $this->fputcsv($upload_data_file, $file_content);
                fclose($upload_data_file);
                unlink($full_path . $file);
            }
            fclose($handle);
            return ($mod_files);
        } catch (Exception $e) {
            file_put_contents($this->LogdirectoryPath, "Error: " . Date('Y-m-d H:i:s') . "Processing file ::" . $e->getMessage() . "  \n", FILE_APPEND);
            return false;
        }
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

}
