<?php 
 include 'libs/db_connect.php';
require_once dirname(__FILE__).'/accesscheck.php'; 

$q = intval($_GET['q']);

try { 
 $query= "select * from templates where id = :id ";			
	$stmt = $con->prepare( $query );	
	$stmt->execute(array(':id' => $q ));
?>
<!-- testing popup files -->

<!-- end testing popup files -->

<?php
  
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

          extract($row); 

 echo "<img src='{$siteroot}{$jpeg_path}' width=500 height=500> </img>";exit;
?>
<?php   
    
}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>

