<?php
date_default_timezone_set("GMT");
//date_default_timezone_set("EST");

class header {

    function __construct() {
        
    }

    function dbConnect() {
    $link = mysql_connect('10.130.225.126','root','ukast*$@!');     
//   $link = mysql_connect('10.128.80.96', 'voice_sdp', 'Vr5fk#s4T');
        if (!$link) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db('mVoice', $link);
    }

    public function checkInstance($script = '') {
        $cmd = "ps -eaf | grep $script | awk {'print $2\" \"$3'}";
        $output = shell_exec($cmd);
        $arr = explode("\n", trim($output));
        $flag = true;
        $temp = 0;
        if (count($arr) > 1) {
            for ($i = 0; $i < count($arr); $i++) {
                if ($temp != 0)
                    $pre = $temp;
                $elseArr = explode(" ", $arr[$i]);
                $temp = trim($elseArr[0]);
                if ($i != 0) {
                    if ($pre != trim($elseArr[1]))
                        $flag = false;
                }
            }
        }
        return $flag;
    }

    public function createDirectory($dir2create) {
        $dir = '';
        $dirarr = explode('/', $dir2create);
        foreach ($dirarr as $key => $value) {
            $dir = $dir . '/' . $value;
            if (!is_dir($dir))
                mkdir($dir);
        }
    }

    public function callURL($request_url, $param = false) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        if ($param)
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $data = curl_exec($ch);
        curl_close($ch);
        return ($data);
    }

    /* public function checkNumber($number) {
      $validateStr = 'Invalid';
      if (strlen($number) == 9) {
      if (preg_match('/^([0]{1})([8]{1})([0]{2})([0-9]{5})$/', $number)) {
      $validateStr = 'Valid';
      }
      }
      if (strlen($number) == 10) {
      if (preg_match('/^([1-9]{1})([0-9]{9})$/', $number)) {
      $validateStr = 'Valid';
      }
      } elseif (strlen($number) == 11) {
      if (preg_match('/^([1]{1})([8]{1})([0]{2})([0-9]{7})$/', $number)) {
      $validateStr = 'Valid';
      } elseif (preg_match('/^([0]{1})([1-9]{1})([0-9]{9})$/', $number)) {
      $validateStr = 'Valid';
      }
      } elseif (strlen($number) == 12) {
      if (preg_match('/^([9]{1})([1]{1})([1-9]{1})([0-9]{9})$/', $number)) {
      $validateStr = 'Valid';
      }
      }
      return $validateStr;
      } */

    public function checkNumber($number) {
        /*if (preg_match('/^([2-9]{1})([0-8]{2})([2-9]{1})(\d{2})(\d{4})$/', $number) && strlen($number) == 10) {
            if (substr($number, 4, 1) == '1' && substr($number, 5, 1) == '1') {
                $validateStr = 'Invalid';
            } else {
                $validateStr = 'Valid';
            }
        } else {
            echo $validateStr = 'Invalid';
        }
        return $validateStr;
    }*/



	   if (strlen($number) == 10) {
		    $validateStr = 'Valid';
		    
		} else {
		     $validateStr = 'Invalid';
		}
		return $validateStr;
         }


    public function get_available_filename($target_dir, $no2dial, $channel_count) {
        $file_arr = Array();
        while (1) {
            if ((int) trim(substr(strstr(shell_exec("uptime"), 'load average:'), 14, 4)) <= 36) {
                $file_count = shell_exec("ls /var/spool/asterisk/outgoing | wc -l");
                if ((int) $file_count < $channel_count) {
                    $uniqueId = substr($no2dial, -10, 10) . "-" . Date("YmdHis") . "-" . rand(1000, 9999);
                    $file_arr['file_name'] = $target_dir . $uniqueId . ".call";
                    return $file_arr;
                }
            }
            sleep(3);
        }
    }

    public function chkTime($start_time, $end_time) {
        $server_hour = date('H:i:s');
        if ($server_hour <= $start_time || $server_hour >= $end_time)
            return false;
        else
            return true;
    }

}

?>
