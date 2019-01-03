<?php
if(!$_GET['colour']) exit;

$image = new Imagick();
$image->newImage(960, 540, new ImagickPixel($_GET['colour']));
$image->setImageFormat('png');

$filename=substr($_GET['colour'],1);
file_put_contents("images/album/".$filename.".png",$image);

?>
<meta http-equiv="refresh" content="0;url=index.php" />