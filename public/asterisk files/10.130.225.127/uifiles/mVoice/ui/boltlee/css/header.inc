 
<script type="text/javascript" src="<?php echo $siteroot; ?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $siteroot; ?>js/jquery-ui-1.8.1.all.min.js"></script>
<script type="text/javascript" src="<?php echo $siteroot; ?>js/jquery.tools.scrollable.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $siteroot; ?>datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript"  type="text/javascript" src="<?php echo $siteroot; ?>js/jslib.js"></script>
<script type="text/javascript"  type="text/javascript" src="<?php echo $siteroot; ?>js/phplistapp.js"></script>
<script type="text/javascript"  type="text/javascript" src="<?php echo $siteroot; ?>ui/dashboard/js/jquery.tablednd.js"></script>
<script type="text/javascript"  type="text/javascript" src="<?php echo $siteroot; ?>ui/dashboard/js/phplist.js"></script>
<script src="<?php echo $siteroot; ?>ui/dashboard/js/validate/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $siteroot; ?>ui/dashboard/js/validate/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="js/js-addons/jquery.form.js"></script>
<script type="text/javascript" src="js/js-addons/veltimail.js" ></script> 
<script type="text/javascript" src="js/js-addons/jquery.base64.js" ></script> 
<script type="text/javascript" src="js/js-addons/jquery.base64.min.js" ></script> 


<link rel="stylesheet" href="<?php echo $siteroot; ?>css/reset.css" />
<link href="<?php echo $siteroot; ?>css/jquery-ui-1.8.1.all.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo $siteroot; ?>css/app.css" />
<link rel="stylesheet" href="<?php echo $siteroot; ?>css/menu.css" />
<!-- dashboard theme -->
<link href="<?php echo $siteroot; ?>ui/dashboard/css/style_css.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $siteroot; ?>ui/dashboard/css/font_awesome.css" rel="stylesheet" type="text/css"/>
<!-- now override the above with the styles and JS from the UI theme -->
<link rel="stylesheet" href="<?php echo $siteroot; ?>ui/dashboard/css/base.css" />
<link rel="stylesheet" href="<?php echo $siteroot; ?>ui/dashboard/css/layout.css" />
<link rel="stylesheet" href="<?php echo $siteroot; ?>ui/dashboard/css/skeleton.css" />
<link rel="stylesheet" href="<?php echo $siteroot; ?>ui/dashboard/css/style.css" />
<link href="<?php echo $siteroot; ?>ui/dashboard/css/style_css.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $siteroot; ?>ui/dashboard/css/font_awesome.css" rel="stylesheet" type="text/css"/>
<!--validation--->
<link href="<?php echo $siteroot; ?>ui/dashboard/css/validate/validationEngine.jquery.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<!-- Style for rtl language <link rel="stylesheet" href="<?php echo $siteroot; ?>ui/dressprow/css/style_rtl.css" /> -->
<style type="text/css" title="currentStyle">
			@import "<?php echo $siteroot; ?>datatable/media/css/demo_page.css";
			@import "<?php echo $siteroot; ?>datatable/media/css/demo_table.css";
		</style>

<?php
if (isset($GLOBALS['config']['head'])) {
  foreach ($GLOBALS['config']['head'] as $sHtml) {
    print $sHtml;
    print "\n";
    print "\n";
  }
}
?>

<!-- 
<style type="text/css">
#containerchart{font-family: "Lucida Grande","Lucida Sans Unicode",Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;  line-height: normal;    overflow: hidden;    position: absolute;    text-align: left;    width: 1251px;    z-index: 0;}
</style> -->
</head><body>
<div id="wrapper">
<div id="warpperInner">
<?php if((isset ($_SESSION["adminloggedin"]) && !empty($_SESSION["adminloggedin"]))){ ?>
<div id="header">
  <h1>Navigation</h1>
  <a class="dropdown-toggle element" data-original-title="Settings" href="<?php echo $siteroot; ?>./?page=home" data-toggle="tooltip" data-placement="bottom"> <i class="icon-cog"></i></a>
  <div  class="logout" style="float:right; width:132px;" >
    <?php
  if ($GLOBALS["require_login"] && (!isset ($_SESSION["adminloggedin"]) || !$_SESSION["adminloggedin"])) {
    print ('<a id="login" href="'.$siteroot.'/?page=home">Login</a> ');
  } 
else
 {      
    #print ('<a id="loginname">Welcome :&nbsp;'.issuperusername().'-['. dtype(isSuperUser()).']</a>');
    #print ('<a id="loginname" href="'.$siteroot.'/?page=logout">Logout</a>');
	?>
	<a href="javascript:void(0);" class="logoutpanel"><span class="username">Welcome &nbsp;<strong style="font-weight:bold;"><?php echo ucfirst(issuperusername()); ?></strong></span>
	<b class="caret" ></b></a>
	 
	 <ul class="log logoutbase" style="display:none;"> 
	<li> <span class="username">  > &nbsp;&nbsp;<small><?php echo dtype(isSuperUser()); ?></small><span></li>
	<?php if(isset($_SESSION["logindetails"]["id"]) && !empty($_SESSION["logindetails"]["id"])){ ?>	
	<li>  <span class="username">  > &nbsp; <small><?php echo ($_SESSION["logindetails"]["type"] == 1)?'Unlimited':(int)credit($_SESSION["logindetails"]["id"]);?></small></span></li>
	<li>  <span class="username"><a  href="<?php echo $siteroot; ?>/?page=logout" style="color:white;"> <img alt="logout" title="logout" width="15" height="15" src="<?php echo $siteroot; ?>ui/dashboard/images/logout_img.png"  />&nbsp;Logout</span></a></li>
	<?php } ?>
	</ul>
	 
	<script type="text/javascript">
	 $(document).ready(function(){
	    $('.logoutpanel').click(function(){
		   if($(this).hasClass('baseopen')=== false){
		     $(this).addClass('baseopen');
		     $('.logoutbase').slideDown();
		   }else{
		     $(this).removeClass('baseopen');
		     $('.logoutbase').slideUp();
		   }
		});
		 
		 
	 });
	</script>
	 
	 

 <?php  }
?>
     </div>
</div>
<?php } ?>
<!-- BEGIN SIDEBAR MENU -->
<?php 
//print topMenu(); 
if(isset ($_SESSION["adminloggedin"]) && !empty($_SESSION["adminloggedin"]))
{
?>
<!-- BEGIN SIDEBAR MENU -->
<?php 
 if($menuItems){ ?>
 <ul class="sidebar-menu">
<?php 	 foreach($menuItems as $mk=>$mI){ 
if($_SESSION['logindetails']['type'] ==3 && $mk == 'Users'){	
 continue;
}
?>
	   <li class="has-sub <?php echo 'menu-'.$mk ?>" ><a href="<?php echo $mI; ?>"  > <span class="icon-box"> <i class="icon-dashboard"></i></span> <?php echo $mk; ?> </a>
	   <?php if(!empty($submenuItems[$mk])){  ?>
         <ul class="sub <?php echo 'submenu-'.$mk; ?>" >
		   <?php   foreach($submenuItems[$mk] as $sk=>$sI){  ?>
          <li><a class="submenus <?php echo 'submenuall-'.$mk; ?>"  href="<?php echo $sI; ?>"><?php echo $sk; ?></a></li>
           <?php }  ?>
           </ul>
		   </li> 
        <?php }  ?>
  <?php } ?>
  
 </ul>
 <?php }  ?>

<?php
}

?>
<!-- END SIDEBAR MENU -->
<!-- BEGIN PAGE CONTAINER-->
<div id="main-content" style="<?php echo (isset ($_SESSION["adminloggedin"]) && !empty($_SESSION["adminloggedin"]))?'margin-left:215px;':'margin-left:0;' ?>">
<div class="container-fluid">
<div class="row-fluid">
<?php if(isset ($_SESSION["adminloggedin"]) && !empty($_SESSION["adminloggedin"])){?>
<h3 class="page-title"><a href="<?php echo $siteroot; ?>#"><small>statistics and more</small></a></h3>
<?php }?>
<?php
if ($GLOBALS["require_login"] && (!isset ($_SESSION["adminloggedin"]) || !$_SESSION["adminloggedin"]))
{  ?>
<?php
}
else 
{ ?>
<!-- BREADCRUMB STARTS --->
<ul class="breadcrumb clearfix">
  <li> <a href="<?php echo $siteroot; ?>"><i class="icon-home"></i></a><span class="divider">&nbsp;</span> </li>
  <li id="bread-1" style="display:none;"><a href="<?php echo $siteroot; ?>#"></a><span class="divider">&nbsp;</span></li>
  <li id="bread-2" style="display:none;"><a href="<?php echo $siteroot; ?>#"></a><span class="divider">&nbsp;</span></li>
  
  <li class="pull-right search-wrap">
    <?php

$sid=$_SESSION["logindetails"]["id"];
//echo "TOTAL CREDITS :".totalrevenue($sid);

?>
  </li>
</ul>
<!-- BREADCRUMB ENDS --->
<?php
}
?>
<script type="text/javascript">
var siteroot = '<?php echo $siteroot ?>';
</script>