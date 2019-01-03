<style>
body, html { 
	background-color: 0000000;
	color: 00ff00;
}
</style>
<?php
unlink("/var/www/html/images/album/".$_GET['img']) or die("Couldn't delete file");
?>
<meta http-equiv="refresh" content="0;url=index.php" />