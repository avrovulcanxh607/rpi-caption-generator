<style>
body, html { 
	background-color: 0000000;
	color: 00ff00;
}
/* Container needed to position the button. Adjust the width as needed */
.container {
  position: relative;
  width: 300px;
  margin-bottom: 2%;
}

/* Make the image responsive */
.container img {
  width: 90%;
  height: auto;
  border:1px solid #00FF00;
}
.container img:hover {
  border:1px solid #ff0000;
}

/* Style the button and place it in the middle of the container/image */
.container .btn {
  position: absolute;
  top: 80%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 12px 10px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  opacity: 0.5;
}

.container .btn:hover {
  background-color: black;
}
.direct {
	left: 20%;
}
.delete {
	left: 70%;
}
div.container{
	float: left;
}
</style>

<title>Caption Generator</title>
<h1>NMS Caption Generator</h1>

<a href="?action=oldglobe"><button>Old Globe</button></a>
<a href="?action=newglobe"><button>New Globe</button></a>
<a href="?action=reset"><button>Reset All</button></a>
<a href="?action=stop"><button>Stop</button></a>

<?php
echo "<br><br>";
switch ($_GET['action'])
{
	case "oldglobe" : ;
		echo exec("sudo /usr/bin/omxplayer /home/pi/long2.mp4 -b");
		echo "<br>Old Globe";
		break;
	case "newglobe" : ;
		echo exec("sudo /usr/bin/omxplayer /home/pi/long1.mp4 -b --aspect-mode stretch");
                echo "<br>New Globe";
                break;
        case "direct" : ;
                echo exec("sudo /usr/bin/fbi -d /dev/fb0 --noverbose -a /var/www/html/images/album/".$_GET['img']." -T 1");
                break;
        case "reset" : ;
                echo exec("/home/pi/reset");
                echo "<br>Reset";
                break;
        case "stop" : ;
                echo exec("sudo killall omxplayer.bin");
                echo "<br>Stopped";
                break;

}

?>

<script language="javascript1.2" type="text/javascript">
function showimageeditor( bild ) {
	LeftPosition = ( screen.width ) ? ( screen.width - 660 ) / 2 : 0;
	TopPosition = ( screen.height ) ? ( screen.height - 700 ) / 2 : 0;
	settings = 'height=600, width=660, top=' + TopPosition + ', left=' + LeftPosition + ', scrollbars=no, resizable=no, menubar=no, dependent=yes, status=no, toolbar=no, fullscreen=yes'
	win = window.open( "aie/imageeditor.php?img=" + encodeURIComponent(bild), "captiongenwin", settings )
	
}

function imagesaved(){
  window.location.reload();  
}
</script>

<h1>Click on an image to add text or upload a new one</h1>

<?php
$images=array_diff(scandir("/var/www/html/images/album",SCANDIR_SORT_NONE), array('..', '.'));
foreach($images as $image)
{
	echo "
	<div class=\"container\">\r\n
		<a href='#' onclick=\"showimageeditor('images/album/$image')\"><img src=\"aie/getthumbnail.php?dat=images/album/$image&maxx=320&maxy=320\" /></a>\r\n
		<a href=\"delete.php?img=$image\"><button class=\"btn delete\">Delete</button></a>\r\n
		<a href=\"?action=direct&img=$image\"><button class=\"btn direct\">Direct</button></a>\r\n
	</div>\r\n
	";
}
?>
<br>
<div style="clear: left">
<h2>Upload a new image</h2>
<p>Recommended settings: 960x540 PNG</p>
<form action="upload.php" method="post" enctype="multipart/form-data">
	Select image to upload:
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload Image" name="submit">
</form>
<h2>Create a new image</h2>
<form action="/solid.php">
	Select a colour:
	<input type="color" name="colour" value="#0000ff">
	<input type="submit" value="Create Image">
</form>
</div>

</html>
