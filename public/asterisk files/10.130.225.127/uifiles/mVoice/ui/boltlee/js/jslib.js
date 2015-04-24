
var helpwin = null;
var helploc = null;
function deleteRec(url) {
	if (confirm("Are you sure you want to delete this record?")) {
		document.location = url;
	}
}

function deleteRec2(msg,url) {
	if (confirm(msg))
		document.location = url;
}

function help(loc) {
	if (helpwin && !helpwin.closed) {
			helpwin.close();
			helpwin = '';
      helploc = loc;
			setTimeout("openhelp()",500)
	} else {
  	helploc = loc;
		openhelp();
  }
}

function openhelp() {
helpwin=window.open(helploc,"help",'screenX=100,screenY=100,width=350,height=350,scrollbars=yes');
  if (window.focus) {helpwin.focus()}
}
function print_self(){
  window.focus();
  if (typeof(window.print) != "undefined"){
    window.print();
  } else {
    show_print_alert();                         
  }
}

function show_print_alert() {
   alert("Please use your browser's print button");
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

var pic = null;
var t_url;
var t_w;
var t_h;
//window.onunload =  closePic;

function viewImage(url,w,h) {
   openpic(url,w,h);
}

function openpic(url,w,h) {
    if (w == null || w == 0) {
		w = 120;
    }
    if (h == null || h == 0){
	h = 120;
    }

    if (pic){
	pic.close();
	pic = null;
	t_url = url;
	t_w = w;
	t_h = h;
	setTimeout("openit()",500);
	} else {
	do_openpic(url,w,h);
	}
}

function openit() {
	do_openpic(t_url,t_w,t_h);
	t_url = null;
	t_w = null;
	t_h = null;
}

function do_openpic(url,w,h) {
    w +=30;
    h +=30;
    //var features = "scrollbars=auto,toolbar=yes,location=yes,menubar=yes,screenx=150,screeny=150";
    var	features = "dependent=yes,width=" + w + ",height=" + h + ",noresize,scrollbars=auto,toolbar=no,location=no,menubar=no,screenx=150,screeny=150";
//    alert(features);
    pic = window.open(url,"picwin",features);
    //    setTimeout("createContent()",100);

}
function createContent(){
    if (!pic.document){
	setTimeout("createContent()",100);
    } else {
	var url ="aaa";
	var w=100;
	var h=200;
	pic.document.write('<html><head><style>body{margin:0}</style></head><body>');
	pic.document.write('<img border=0 src=\"');
	pic.document.write(url);
	pic.document.write('\" width=');
	pic.document.write(w);
	pic.document.write(' height=');
	pic.document.write(h);
	pic.document.write('></body></html>');
	if (window.focus){pic.focus();}
    }
}
function echeck(str) {
var id='/[0-9]/';
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
	   return false
	}

	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   return false
	}

	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
	    return false
	}

	 if (str.indexOf(at,(lat+1))!=-1){
	    return false
	 }

	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		 return false
	 }

	 if (str.indexOf(dot,(lat+2))==-1){
		 return false
	 }
	
	 if (str.indexOf(" ")!=-1){
	    return false
	 }

		 return true					
}
function empty(str)
{
	ans = str.match(/^\s*$/);
	return ans;
}

function AddRec() {

	/* var campname=document.getElementById('campname').value;
	var campsubj=document.getElementById('campsubject').value;
	var campfrom=document.getElementById('campfromfield').value;
	var campfromdisp=document.getElementById('campfromName').value;
	//var campfile=document.getElementById('file_campaign').value;
	// var campupload=campfile.split('.');
	if(empty(campname)!=null){
		alert("Please Enter Your Campaign Name");
		document.getElementById('campname').focus();
		return false;
	}
	else if(empty(campsubj)!=null||campsubj=='' ){
		alert("Please Enter Your Subject Name ");
		document.getElementById('campsubject').focus();
		return false;
	}
	else if(empty(campfromdisp)!=null||campfromdisp==''){
		alert("Please Enter Your From Name");
		document.getElementById('campfromName').focus();
		return false;
	}
	else if(empty(campfrom)!=null||campfrom==''){
		alert("Please Enter Campaign Email id in From Field");
		document.getElementById('campfromfield').focus();
		return false;
	}
	else if(echeck(campfrom)==false){
		alert("Invalid E-mail Id Please Enter A Vaild E-mail Id");
		document.getElementById('campfromfield').focus();
		return false;
	}
	/* else if(empty(campfile)!=null||campfile==''){
		alert("Please Upload a campaign File");
		document.getElementById('file_campaign').focus();
		return false;
	} 
	else if(campupload[1]!='html'){
		alert("Campaign Only Supported For HTML File Extension");
		document.getElementById('file_campaign').focus();
		return false;
	} 
	else{*/
		if (confirm("Are you sure you want to add this campaign?")) {
			document.getElementById('hiddenCampaign').value="1";
			document.forms[0].submit();
			document.forms[0].action = "?page=campaign";
		}
		return true;
	/* } */
}

function grouprec()
{  
var listname=document.getElementById('listname').value;
	var gtype=document.getElementById('gtype').value;
		var owner=document.getElementById('owner').value;
	
if(listname==''){
		alert("Please Enter Your groupname");
		document.getElementById('listname').focus();
		return false;
	}
	
	return true;
  }




 function editRec() {
	
		res=confirm("Are you sure you want to edit this campaign?");
	if(res) 
		{
			document.getElementById('hiddenCampaign').value="1";
			document.forms[0].submit();
			document.forms[0].action = "?page=editcampaign";
		}
		return true;
	}


function selectcampaign(){
	var campaign=document.getElementById('campselect').value;
	if(empty(campaign)){
		alert("Please Select A Campaign");
	}else{
    document.forms[0].action='?page=broadcastcampaign&Action=broadcast&sortby='+campaign;
	}
   }
function previewcampaign(campaign)
{
	document.location='?page=broadcastcampaign&sortby='+campaign;
	}
function sendcampaign(){
	
	if (confirm("Are you sure you want to send this campaign?")) {
		document.forms[0].submit();
		document.forms[0].action ='?page=broadcastcampaign';
	
	}
	
}


function compare() {
		var f = document.broadcastcamp;
		f.target = "_blank";

		prevAction = f.action;
		f.action = "?page=previewcampaign&omitall=yes";
		f.submit();

		f.target = "";
		f.action = prevAction;
//	window.open("?page=previewcampaign","help",'screenX=100,screenY=100,width=850,height=750,scrollbars=yes');
	}
function select(value)
{
if(value =='delete')
{
document.getElementById("movedestination").style.display="none" ;
}
else
{
document.getElementById("movedestination").style.display="inline";
}

}
function goBack()
  {
  window.history.go(-1);
  }