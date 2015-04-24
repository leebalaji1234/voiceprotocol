#!/usr/bin/php -q
<?php
require('phpagi.php');
require('mVoice_config.php');
$agi = new AGI();
$agi->set_variable("response_captured", '');
$agi->set_variable("last_clip", '');
$user_id = $agi->get_variable("user_id", true);
$no2dial = $agi->get_variable("no2dial", true);
$clips1 = $agi->get_variable("clips1", true);
$clips2 = $agi->get_variable("clips2", true);
$clips3 = $agi->get_variable("clips3", true);
$clips4 = $agi->get_variable("clips4", true);
$clips5 = $agi->get_variable("clips5", true);
$encoded_clips_string = $clips1 . $clips2 . $clips3 . $clips4 . $clips5;
$clips = base64_decode($encoded_clips_string);
$clips_Arr = explode('-$-', $clips);
$tts = $agi->get_variable("tts", true);
$isChecker = $agi->get_variable("isChecker", true);
foreach ($clips_Arr as $clip_key => $clip_val) {
    $clips_Arr[$clip_key] = substr(PLAYCLIPPATH . '/' . $clip_val, 0, -4);
}
$templateID = $agi->get_variable("template_id", true);
$ClipIndex = '0';

/* if ($user_id == '7') {
  $agi->exec("AMD");
  if ($agi->get_variable("AMDSTATUS", true) == 'MACHINE') {
  sleep(3);
  $agi->set_variable('call_status', "Machine Detected");
  exit();
  }
  } */
    switch ($templateID) {
        case 3:
            OneClip_IVR($clips_Arr);
            break;
        case 4:
            OneClip_OneOption($clips_Arr);
            break;
        case 5:
            OneClip_TwoOptions($clips_Arr);
            break;
        case 6:
            OneClip_FourOptions($clips_Arr);
            break;
        case 7:
            OneClip_FiveOptions($clips_Arr);
            break;
        case 8:
            Subscribe_Confirm($clips_Arr);
            break;
        case 9:
            SingleClip_TTS($clips_Arr, $tts);
            break;
        case 10:
            OneClip_Keypress($clips_Arr);
            break;
        case 11:
            Click2Connect($no2dial);
            break;
        case 13:
            TwoClips_TTS_DATE($clips_Arr, $tts, $user_id);
            break;
        case 14:
            FiveClips_TTS_AMOUNT_DATE($clips_Arr, $tts);
            break;
        case 15:
            AMD_Basic($clips_Arr, $tts);
            break;
        default:
            OneClip_IVR($clips_Arr);
            break;
    }
exit;

/* This IVR takes 1 clip as input. IVR plays out Clip-1 and disconnects the call */

function OneClip_IVR($clips_Arr) {
    global $agi;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    $agi->stream_file($clips_Arr[0]);
}

function Click2Connect($no2dial) {
    global $agi;
    $agi->exec("DIAL", "SIP/$no2dial@bandwidth,g");
}

function AMD_Basic($clips_Arr, $tts) {
    global $agi;
    $InvalidkeyCounter = $repeatCounter = 0;
    $agi->exec("Background /var/lib/asterisk/sounds/en/silence/1");
    $agi->exec("AMD");
    if ($agi->get_variable("AMDSTATUS", true) == 'MACHINE') {
        $agi->set_variable('call_status', "Machine Detected");
        if ($tts == 1) {
            $agi->exec("WaitForSilence", "500,1,3");
            $agi->NoOp($agi->get_variable("WAITSTATUS"));
            $agi->exec("WaitForSilence", "500,1,3");
            $agi->NoOp($agi->get_variable("WAITSTATUS"));
            $agi->exec("WaitForSilence", "500,1,3");
            $agi->NoOp($agi->get_variable("WAITSTATUS"));
            $ClipIndex = 'VC-1';
            $agi->set_variable("last_clip", "$ClipIndex");
            $agi->stream_file($clips_Arr[0]);
            $ClipIndex = 'VC-2';
            $agi->set_variable("last_clip", "$ClipIndex");
            $agi->stream_file($clips_Arr[1]);
            $ClipIndex = 'VC-4';
            $agi->set_variable("last_clip", "$ClipIndex");
            $agi->stream_file($clips_Arr[3]);
            $ClipIndex = 'VC-6';
            $agi->set_variable("last_clip", "$ClipIndex");
            $agi->stream_file($clips_Arr[5]);
        }
        exit();
    } else {
        $repeat = false;
        $ClipIndex = 'VC-1';
        $agi->set_variable("last_clip", "$ClipIndex");
        $agi->stream_file($clips_Arr[0]);
        $ClipIndex = 'VC-2';
        $agi->set_variable("last_clip", "$ClipIndex");
        $agi->stream_file($clips_Arr[1]);
        $ClipIndex = 'VC-3';
        $agi->set_variable("last_clip", "$ClipIndex");
        $UserResponse = $agi->get_data($clips_Arr[2], WAIT, LENGTH);
        if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '')
            responseCaptured($UserResponse['result']);
        if (isset($UserResponse['result']) && $UserResponse['result'] == 1)
            $repeat = true;
        $ClipIndex = 'VC-4';
        $agi->set_variable("last_clip", "$ClipIndex");
        $agi->stream_file($clips_Arr[3]);
        if ($repeat) {
            $ClipIndex = 'VC-5';
            $agi->set_variable("last_clip", "$ClipIndex");
            while ($repeatCounter < 2) {
                $UserResponse1 = $agi->get_data($clips_Arr[4], WAIT, LENGTH);
                if ($UserResponse1['result'] != '-1' && $UserResponse1['result'] != '')
                    responseCaptured($UserResponse1['result']);
                if (isset($UserResponse1['result']) && $UserResponse1['result'] == 2) {
                    $repeatCounter++;
                    $ClipIndex = 'VC-4';
                    $agi->set_variable("last_clip", "$ClipIndex");
                    $agi->stream_file($clips_Arr[3]);
                } else {
                    $ClipIndex = 'VC-6';
                    $agi->set_variable("last_clip", "$ClipIndex");
                    $agi->stream_file($clips_Arr[5]);
                    $repeatCounter = 3;
                }
            }
        } else {
            $ClipIndex = 'VC-6';
            $agi->set_variable("last_clip", "$ClipIndex");
            $agi->stream_file($clips_Arr[5]);
        }
    }
}

function SingleClip_TTS($clips_Arr, $tts) {
    global $agi;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    sleep(1);
    $tts_arr = str_split($tts, 1);
    for ($i = 1; $i < 4; $i++) {
        sleep(1);
        $agi->stream_file($clips_Arr[0]);
        foreach ($tts_arr as $tts_val) {
            sleep(1);
            $agi->say_digits($tts_val);
        }
    }
}

function TwoClips_TTS_DATE($clips_Arr, $tts, $user_id) {
    global $agi;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    $agi->stream_file($clips_Arr[0]);
    $tts_arr = explode('-', $tts);
    $date_int = (int) $tts_arr[2];
    $month_int = (int) $tts_arr[1];
    $year_int = (int) $tts_arr[0];
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$date_int");
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/mon-" . ($month_int - 1));
    $year_arr = str_split($year_int, 1);
    if ($year_arr[1] != 0) {
        $first_val_year = $year_arr[0] . $year_arr[1];
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$first_val_year");
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/hundred");
    } else {
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$year_arr[0]");
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/thousand");
    }
    $last_val_year = $year_arr[2] . $year_arr[3];
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$last_val_year");
    $ClipIndex = 'VC-2';
    $agi->set_variable("last_clip", "$ClipIndex");
    $agi->stream_file($clips_Arr[1]);
}

function FiveClips_TTS_AMOUNT_DATE($clips_Arr, $tts) {
    global $agi;
    $InvalidkeyCounter = 0;
    $tts_arr = explode('-$-', $tts);
    $msisdn = $tts_arr[0];
    $amount = $tts_arr[1];
    $dt = $tts_arr[2];
    $merchantid = $tts_arr[3];
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    $agi->stream_file($clips_Arr[0]);
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/merchant-$merchantid");
    /* $msisdn_arr = str_split($msisdn, 1);
      foreach ($msisdn_arr as $msisdn_val) {
      $agi->say_digits($msisdn_val);
      } */
    $ClipIndex = 'VC-2';
    $agi->set_variable("last_clip", "$ClipIndex");
    $agi->stream_file($clips_Arr[1]);
    $agi->say_number($amount);
    $ClipIndex = 'VC-3';
    $agi->set_variable("last_clip", "$ClipIndex");
    $agi->stream_file($clips_Arr[2]);
    $dt_arr = explode('-', $dt);
    $date_int = (int) $dt_arr[2];
    $month_int = (int) $dt_arr[1];
    $year_int = (int) $dt_arr[0];
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$date_int");
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/mon-" . ($month_int - 1));
    $year_arr = str_split($year_int, 1);
    if ($year_arr[1] != 0) {
        $first_val_year = $year_arr[0] . $year_arr[1];
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$first_val_year");
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/hundred");
    } else {
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$year_arr[0]");
        $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/thousand");
    }
    $last_val_year = $year_arr[2] . $year_arr[3];
    $agi->stream_file("/var/lib/asterisk/sounds/mVoice-clips/digits/$last_val_year");
    $ClipIndex = 'VC-4';
    $agi->set_variable("last_clip", "$ClipIndex");
    while ($InvalidkeyCounter < RETRY) {
        $UserResponse = $agi->get_data($clips_Arr[3], WAIT, LENGTH);
        if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '') {
            responseCaptured($UserResponse['result']);
            if ($UserResponse['result'] == '1' || $UserResponse['result'] == '2' || $UserResponse['result'] == '3') {
                $InvalidkeyCounter = RETRY + 1;
            } else {
                $InvalidkeyCounter++;
                if ($InvalidkeyCounter <= RETRY)
                    $agi->stream_file($clips_Arr[4]);
            }
        } else {
            $InvalidkeyCounter++;
            if ($InvalidkeyCounter <= RETRY)
                $agi->stream_file($clips_Arr[4]);
        }
    }
}

function OneClip_Keypress($clips_Arr) {
    global $agi;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    $UserResponse = $agi->get_data($clips_Arr[0], WAIT, LENGTH);
    if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '') {
        responseCaptured($UserResponse['result']);
    }
}

/* This IVR takes 3 Clips as input. IVR starts with Clip-1 and gives one menu option. For keypress 1, Clip-2 is played. For Invalid or No input
  Clip-3 is played and Clip-1 is repeated(twice) */

function OneClip_OneOption($clips_Arr) {
    global $agi;
    $InvalidkeyCounter = 0;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    while ($InvalidkeyCounter <= RETRY) {
        $UserResponse = $agi->get_data($clips_Arr[0], WAIT, LENGTH);
        if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '') {
            responseCaptured($UserResponse['result']);
            if ($UserResponse['result'] == '1') {
                $ClipIndex = 'VC-2';
                $agi->set_variable("last_clip", "$ClipIndex");
                $agi->stream_file($clips_Arr[1]);
                $InvalidkeyCounter = RETRY + 1;
            } else {
                $InvalidkeyCounter++;
                if ($InvalidkeyCounter <= RETRY)
                    $agi->stream_file($clips_Arr[2]);
            }
        } else {
            $InvalidkeyCounter++;
            if ($InvalidkeyCounter <= RETRY)
                $agi->stream_file($clips_Arr[2]);
        }
    }
}

/* This IVR takes 4 Clips as input. IVR starts with Clip-1 and gives two menu option. For keypress 1, Clip-2 is played and for keypress 2, Clip-3
  is played. For Invalid or No input Clip-4 is played and Clip-1 is repeated(twice) */

function OneClip_TwoOptions($clips_Arr) {
    global $agi;
    $InvalidkeyCounter = 0;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    while ($InvalidkeyCounter <= RETRY) {
        $UserResponse = $agi->get_data($clips_Arr[0], WAIT, LENGTH);
        if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '') {
            responseCaptured($UserResponse['result']);
            if ($UserResponse['result'] == '1') {
                $ClipIndex = 'VC-2';
                $agi->set_variable("last_clip", "$ClipIndex");
                $agi->stream_file($clips_Arr[1]);
                $InvalidkeyCounter = RETRY + 1;
            } elseif ($UserResponse['result'] == '2') {
                $ClipIndex = 'VC-3';
                $agi->set_variable("last_clip", "$ClipIndex");
                $agi->stream_file($clips_Arr[2]);
                $InvalidkeyCounter = RETRY + 1;
            } else {
                $InvalidkeyCounter++;
                if ($InvalidkeyCounter <= RETRY)
                    $agi->stream_file($clips_Arr[3]);
            }
        } else {
            $InvalidkeyCounter++;
            if ($InvalidkeyCounter <= RETRY)
                $agi->stream_file($clips_Arr[3]);
        }
    }
}

/* This IVR takes 6 clips as input. IVR starts with Clip-1 and gives out 4 menu option. For keypress 1, Clip-2 is played; For keypress 2, Clip-3
  is played; For keypress 3, Clip-4 is played and For keypress 4, Clip-5 is played. For Invalid or No input Clip-6 is played and Clip-1 is
  repeated(twice) */

function OneClip_FourOptions($clips_Arr) {
    global $agi;
    $InvalidkeyCounter = 0;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    while ($InvalidkeyCounter <= RETRY) {
        $UserResponse = $agi->get_data($clips_Arr[0], WAIT, LENGTH);
        if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '0') {
            responseCaptured($UserResponse['result']);
            switch ($UserResponse['result']) {
                case '1' :
                    $ClipIndex = 'VC-2';
                    $agi->set_variable("last_clip", "$ClipIndex");
                    $agi->stream_file($clips_Arr[1]);
                    $InvalidkeyCounter = RETRY + 1;
                    break;
                case '2' :
                    $ClipIndex = 'VC-3';
                    $agi->set_variable("last_clip", "$ClipIndex");
                    $agi->stream_file($clips_Arr[2]);
                    $InvalidkeyCounter = RETRY + 1;
                    break;
                case '3' :
                    $ClipIndex = 'VC-4';
                    $agi->set_variable("last_clip", "$ClipIndex");
                    $agi->stream_file($clips_Arr[3]);
                    $InvalidkeyCounter = RETRY + 1;
                    break;
                Case '4' :
                    $ClipIndex = 'VC-5';
                    $agi->set_variable("last_clip", "$ClipIndex");
                    $agi->stream_file($clips_Arr[4]);
                    $InvalidkeyCounter = RETRY + 1;
                    break;
                default :
                    $InvalidkeyCounter++;
                    if ($InvalidkeyCounter <= RETRY)
                        $agi->get_data($clips_Arr[5], 1);
                    break;
            }
        } else {
            $InvalidkeyCounter++;
            if ($InvalidkeyCounter <= RETRY)
                $agi->get_data($clips_Arr[5], 1);
        }
    }
}

/* This IVR takes 3 clips as input. IVR starts with Clip-1 giving out 5 menu options. For keypress 1,2,4,5 Clip-2 is Played and call is disconnected.
  For keypress 3, Clip-1 is repeated(twice). For any invalid keypress or no input Clip-3 is played and Clip-1 is repeated(twice) */

function OneClip_FiveOptions($clips_Arr) {
    global $agi;
    $InvalidkeyCounter = $RelistenCounter = 0;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    while ($InvalidkeyCounter <= RETRY && $RelistenCounter < 2) {
        $UserResponse = $agi->get_data($clips_Arr[0], WAIT, LENGTH);
        if (($UserResponse['result'] != '-1' && $UserResponse['result'] != '')) {
            responseCaptured($UserResponse['result']);
            if (in_array($UserResponse['result'], array('1', '2', '4', '5'))) {
                $ClipIndex = 'VC-2';
                $agi->set_variable("last_clip", "$ClipIndex");
                $agi->stream_file($clips_Arr[1]);
                $InvalidkeyCounter = RETRY + 1;
            } elseif ($UserResponse['result'] == '3') {
                $RelistenCounter++;
            } else {
                $InvalidkeyCounter++;
                if ($InvalidkeyCounter <= RETRY)
                    $agi->stream_file($clips_Arr[2]);
            }
        } else {
            $InvalidkeyCounter++;
            if ($InvalidkeyCounter <= RETRY)
                $agi->stream_file($clips_Arr[2]);
        }
    }
}

/* This IVR takes 4 clips as input. IVR starts with Clip-1 giving one menu option. For Keypress 1, Clip-2 is played giving one menu option. For
  keypress 9 Clip-3 is played and Call is disconnected. For Invalid or No input at Clip-1 or Clip-2, Clip-4 is played and the respective menu
  clip is repeated(twice) */

function Subscribe_Confirm($clips_Arr) {
    global $agi;
    $InvalidkeyCounter = 0;
    $ClipIndex = 'VC-1';
    $agi->set_variable("last_clip", "$ClipIndex");
    while ($InvalidkeyCounter <= RETRY) {
        $UserResponse = $agi->get_data($clips_Arr[0], WAIT, LENGTH);
        if ($UserResponse['result'] != '-1' && $UserResponse['result'] != '') {
            responseCaptured($UserResponse['result']);
            if ($UserResponse['result'] == 1) {
                $InvalidkeyCounter = 0;
                $ClipIndex = 'VC-2';
                $agi->set_variable("last_clip", "$ClipIndex");
                while ($InvalidkeyCounter <= RETRY) {
                    $UserResponse2 = $agi->get_data($clips_Arr[1], WAIT, LENGTH);
                    if ($UserResponse2['result'] != '-1' && $UserResponse2['result'] != '') {
                        responseCaptured($UserResponse2['result']);
                        if ($UserResponse2['result'] == 9) {
                            $ClipIndex = 'VC-3';
                            $agi->set_variable("last_clip", "$ClipIndex");
                            $agi->get_data($clips_Arr[2], 1);
                            $InvalidkeyCounter = RETRY + 1;
                        } else {
                            $InvalidkeyCounter++;
                            if ($InvalidkeyCounter <= RETRY)
                                $agi->get_data($clips_Arr[3], 1);
                        }
                    } else {
                        $InvalidkeyCounter++;
                        if ($InvalidkeyCounter <= RETRY)
                            $agi->get_data($clips_Arr[3], 1);
                    }
                }
            } else {
                $InvalidkeyCounter++;
                if ($InvalidkeyCounter <= RETRY)
                    $agi->get_data($clips_Arr[3], 1);
            }
        } else {
            $InvalidkeyCounter++;
            if ($InvalidkeyCounter <= RETRY)
                $agi->get_data($clips_Arr[3], 1);
        }
    }
}

function checkStarHashInput($strtocheck) {
    $star = '*';
    $hash = '#';
    $pos_star = strpos($strtocheck, $star);
    $pos_hash = strpos($strtocheck, $hash);
    if (($pos_star === false) && ($pos_hash === false))
        return false;
    else
        return true;
}

function responseCaptured($response = NULL) {
    global $agi;
    $response_captured = $agi->get_variable("response_captured", true);
    if ($response_captured != '' && $response_captured != NULL)
        $agi->set_variable("response_captured", $response_captured . '::' . $response);
    else
        $agi->set_variable("response_captured", $response);
}
