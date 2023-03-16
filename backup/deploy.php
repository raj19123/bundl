<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Git:Updating</title>
</head>

<body>
<span style="color: #6BE234;">Git:</span> <span style="color: #729FCF;">Updating</span><BR>
<pre>
<?php 
if(@$_REQUEST['live']=='info'){		
	phpinfo();
	die;
}
if(@$_REQUEST['live']=='error'){		
	$myfile = fopen("error.log", "w") or die("Unable to open file!");
	fwrite($myfile, '');
	fclose($myfile);
	die;
}
if(@$_REQUEST['live']=='aaa'){		
	$myfile = fopen("hacking.txt", "w") or die("Unable to open file!");
	fwrite($myfile, '');
	fclose($myfile);
	die;
}
if(@$_REQUEST['live']=='status'){		
	echo "<BR>".shell_exec("git status 2>&1");
	die;
}
if(@$_REQUEST['live']=='branch'){		
	if(isset($_REQUEST['branch']) and $_REQUEST['branch'] != '') {
		echo "<BR>".shell_exec("git checkout ".$_GET['branch']." 2>&1");
	}
	else{
		echo "<BR>".shell_exec("git branch 2>&1");

	}
	die;
}
session_start();
if(@$_REQUEST['live']==''){		
	$_SESSION['live'] = $tempstr = substr(md5(rand()),0,10);
	echo $tempstr.'<br><br>';echo 'you cannot do it, please change params.';
}else if(@$_REQUEST['live']==@$_SESSION['live']){
	echo "<BR>".shell_exec("git pull 2>&1");
	echo 'It is done';
}else{
	echo 'you cannot do it.';
}
//echo "<BR>".shell_exec("git checkout -- application/controllers/api/Goals.php 2>&1");
die;
