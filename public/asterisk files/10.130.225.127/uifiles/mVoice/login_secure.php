<?php
session_start();
$message="";
if(count($_POST)>0) {

require_once dirname(__FILE__).'/config.php';
$config=new config();
$username=mysql_real_escape_string($_POST["loginname"]);
$password=mysql_real_escape_string($_POST['password']);
//echo "SELECT * FROM users WHERE username='$username' and password = '$password' where isActive=1 and channel LIKE '%GUI%' LIMIT 1";
//exit;
$result = mysql_query("SELECT * FROM users WHERE username='$username' and password = '$password' and isActive=1 and channel LIKE '%GUI%' LIMIT 1");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
 $_SESSION["id"] = $row['userid'];
 $_SESSION["name"] = $row['username'];
 $_SESSION["usertype"] = $row['rolename'];
 $_SESSION["masterid"] = $row['masterid'];
 $_SESSION["type"] = $row['usertype'];
 $_SESSION["dialler"] = $row['dialler'];
} 
else {
echo $message = "Invalid Username or Password!";
?>
<script type="text/javascript">
function Redirect()
{
  window.location="index.php";
}
document.write("<div style='float:left;'>Page will be  redirected  in 3 sec.</div>");
setTimeout('Redirect()', 3000);
</script>
<?php
}
}
if(isset($_SESSION["id"]) && $_SESSION['usertype']==1) {
echo $message ="successfully redirect";
header("Location:index_inner.php");
}

elseif(isset($_SESSION["id"]) && $_SESSION['usertype']==2) {
echo $message ="successfully redirect";
header("Location:dashboard.php");
}

elseif(isset($_SESSION["id"]) && $_SESSION['usertype']==3) {
echo $message ="successfully redirect";
header("Location:createobd_new_1.php");
}

elseif(isset($_SESSION["id"]) && $_SESSION['usertype']==5) {
echo $message ="successfully redirect";
header("Location:createobd_new_1.php");
}

?>
