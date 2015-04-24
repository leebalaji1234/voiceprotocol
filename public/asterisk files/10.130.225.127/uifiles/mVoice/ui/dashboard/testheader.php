
<html>
<head>
<title>Vmail - Transaction </title>

 
<script type="text/javascript" language="javascript" src="<?php echo $siteroot; ?>media/js/jquery-1.4.4.min.js"></script>
<script src="<?php echo $siteroot; ?>media/js/jquery.dataTables.min.js" type="text/javascript"></script>


        <script src="<?php echo $siteroot; ?>media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="<?php echo $siteroot; ?>media/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>

		
<style type="text/css" title="currentStyle">
			@import "<?php echo $siteroot; ?>datatable/media/css/demo_page.css";
			@import "<?php echo $siteroot; ?>datatable/media/css/demo_table.css";
@import "<?php echo $siteroot; ?>media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>

<link href="<?php echo $siteroot; ?>ui/boltlee/css/style_css.css" rel="stylesheet" type="text/css"/>

<!----validation ---->
<script type="text/javascript" language="javascript" src="<?php echo $siteroot; ?>datatable/media/js/jquery-1.9.1.js"></script>

<script src="<?php echo $siteroot; ?>ui/boltlee/js/validate/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script src="<?php echo $siteroot; ?>ui/boltlee/js/validate/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

<link href="<?php echo $siteroot; ?>ui/boltlee/css/validate/validationEngine.jquery.css" rel="stylesheet" type="text/css" charset="utf-8"/>

<!---- validation --------->  


<!--Menu region -->
  


<script type="text/javascript" src="<?php echo $siteroot; ?>js/ddaccordion.js"></script>

<script type="text/javascript">
ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<style type="text/css">
.wrapper_inner { margin: 0 auto 20px;width:800px; }
.wrapper_menu {  width:192px; float:left;margin-left:12px; }

.arrowlistmenu{
width: 180px; /*width of accordion menu*/
}
.arrowlistmenu .menuheader{ /*CSS class for menu headers in general (expanding or not!)*/
font: bold 14px Arial;
color: white;
background: black url("images/titlebar.png") repeat-x center left;
margin-bottom: 10px; /*bottom spacing between header and rest of content*/
text-transform: uppercase;
padding: 4px 0 4px 10px; /*header text is indented 10px*/
cursor: hand;
cursor: pointer;
}
.arrowlistmenu .openheader{ /*CSS class to apply to expandable header when it's expanded*/
background-image: url("images/titlebar-active.png");
}
.arrowlistmenu ul{ /*CSS for UL of each sub menu*/
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 8px; /*bottom spacing between each UL and rest of content*/
}
.arrowlistmenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}
.arrowlistmenu ul li a{
color: #A70303;
background: url("images/arrowbullet.png") no-repeat center left; /*custom bullet list image*/
display: block;
padding: 2px 0;
padding-left: 19px; /*link text is indented 19px*/
text-decoration: none;
font-weight: bold;
border-bottom: 1px solid #dadada;
font-size: 90%;
}
.arrowlistmenu ul li a:visited{
color: #A70303;
}

.arrowlistmenu ul li a:hover{ /*hover state CSS*/
color: #A70303;
background-color: #F3F3F3;
}
</style>

<!-- end menu --->

</head>
<body>
<div style="margin: 30px auto;
    padding: 0;
    width: 100%;">

