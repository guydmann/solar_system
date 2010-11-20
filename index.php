<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
/*
if (!isset($_GET['clock']) || $_GET['clock'] <= "") { 
	$center_script = "";
} else {
	$center_script = " onLoad='setClock(" . $_GET['clock'] . ")'";
}
*/
include("../../header.html"); ?>

<body >

<?php include("../../topbar.phtml"); ?>
<script type="text/javascript" src="./Three.js"></script>


<div style="padding: 3em">
<h2>Solar System App</h2>
<br>The git repository is <a href="http://github.com/guydmann/solar_system">here</a>
<br><br>
<br>
<?php include("./solar_system.php"); ?>
</div>
</body>
</html>

