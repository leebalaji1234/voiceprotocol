<?php
class Download{
 function __construct(){
  
 }
 function downloadFile($filename=false,$arrHeaders,$datas){
     
    if(!$filename){ return false;}
    if(!$format){ $format = 'csv';}
    ob_end_clean();
    $filename = trim(strip_tags($filename));
    header("Content-type: ".$GLOBALS["export_mimetype"].'; charset=UTF-8');
    header("Content-disposition: attachment; filename=\"$filename\"");
    $col_delim = ",";
    if ($format == 'xls') {
      $col_delim = ",";
     }
    $row_delim = "\n";
    if($arrHeaders){ 
     foreach($arrHeaders as $ck=>$cv){ 
        print ucfirst($cv).$col_delim; 
      }
      print $row_delim;
    } 
    if($datas){ 
	
     foreach($datas as $ck1=>$arrvals){
		  foreach($arrvals as $ck2=>$vals)
		  {  
		 	  print ucfirst($vals).$col_delim; 
		  } 
		  print $row_delim;
	 }
    }
    return true;
 }
 
}


?>