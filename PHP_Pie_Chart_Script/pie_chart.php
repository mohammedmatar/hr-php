<?php
//The values passed as query strings are stored in arrays
$values = explode(",",$_GET['values']);
$names = explode(",",$_GET['names']);

//Modify this line to suite the location of the font file
$fontfile = "arial.ttf";

//This function handles errors while passing the values
function error_image($errMsg)
{
$errImg=ImageCreate(400,30);
$white = ImageColorAllocate($errImg, 255, 255, 255);
imagettftext($errImg, 10, 0, 10, 20, ImageColorAllocate($errImg,0,0,0), $GLOBALS['fontfile'], $errMsg);
header("Content-type: image/png");
ImagePNG($errImg);
ImageDestroy($errImg);
exit;
}

//Display error if no. of values NOT EQUAL TO no. of names
if(count($values)!=count($names))
{
error_image("The Number of names and values should be equal");
}

//Display error if names or values are not specified
if(empty($_GET['names']) || empty($_GET['values']))
{
error_image("Values for both Both \"names\" and \"values\" should be passed");
}

//Pie Chart code starts
$myImage = ImageCreate(220,220+20*count($names));
$white = ImageColorAllocate($myImage, 255, 255, 255);
$black = ImageColorAllocate($myImage, 0, 0, 0);
imagefilledrectangle($myImage, 0, 0, 399, 29, $white);
$start = 0;
for($i=0;$i<count($values);$i++)
{
$r = rand(0,255);
$g = rand(0,255);
$b = rand(0,255);
ImageFilledArc($myImage, 110, 110, 200, 200, $start, $start+($values[$i]/array_sum($values))*360, ImageColorAllocate($myImage, $r, $g, $b), IMG_ARC_PIE);
imagefilledrectangle($myImage, 0, 214+20*$i, 20, 224+20*$i, ImageColorAllocate ($myImage, $r, $g, $b));
imagettftext($myImage, 10, 0, 25, 224+20*$i, $black, $fontfile,$names[$i]." (".round($values[$i]/array_sum($values)*100)."%)");
$start += ($values[$i]/array_sum($values))*360;
}
header("Content-type: image/png");
ImagePNG($myImage);
ImageDestroy($myImage);
?>