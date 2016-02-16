<?
/*  Cool Javascript Slideshow
	Version: 1.2g
	Written By: Jeff Baker	Copyright April 2, 2010
	Website: www.seabreezecomputers.com/slideshow
		
	Description: This Javascript/PHP will display a slideshow with
	crossfade transitions and more, including photo effects.
	It grabs the photos automatically and dynamically from the $folder
	that you specify below or the current folder.
	
	Copy and paste the following in your HTML document where you 
	want the slideshow to appear:
	<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript" SRC="phpslide.php"></SCRIPT>
*/

$folder = "images/"; // if your photos are in a different folder specify it here
// example: var folder = 'images/'; 
// or same folder as this file then: var folder = './';
$photosize = 512; // width to show photos at
$quality = 70; // image quality; 100 = highest quality and largest file size
// keep the quality at 70 or lower if you are getting image flicker because
// of loading of the image files between transitions
$get_exif = 1; // 0 = Do not load exif description data from jpg's; 1 = load exif descriptions from jpg's

$phwidth = 512; // pictureholder width
$phheight = 384; // pictureholder height
$phheight = 384; // pictureholder height
// pictureholder DIV also has the class 'pictureholder' so you can add CSS border etc.
$seconds = 5; // switch photos n seconds
$randomize_photos = 0; // 0 = Do not randomize photos; 1 = Randomize photos
$display_caption = 1; // 0 = No caption; 1 = Display efix jpg Description below photo
$caption_height = 50; // How many pixels high for caption box if on
$caption_border = 1; // Caption border pixels
// captionholder DIV has the class 'captionholder' so you can add CSS
$pan_zoom = 1.3;  // how many times to zoom before panning
$trans = "random"; // default transition between photos
$effect = "random"; // default effect on photos
/* 	The trans variable stands for transitions.  The following trans are possible:
	none, random, crossfade, zoom(from), wipe(from), slide(from)
	from = upperleft, top, upperright, left, center, right, lowerleft, bottom, lowerright
	(*slide does not support center)
	(**wipe supports left, right, center, top and bottom)
*/
/*	The effect variable is for photo effects.  Possible options are:
	none, random, zoomin(to), zoomout(to), pan(to)
	to = upperleft, top, upperright, left, center, right, lowerleft, bottom, lowerright
	(*pan does not support center)
*/
$cur_pic = 0; // which photo to start with. 0 is first photo in album.
$trans_amount = 20; // amount of steps for transitions
$effect_amount = 100; // amount of steps for effects
$testing_mode = 0; // 0 = off; 1 = on; testing mode creates a DIV with ID testing to display testing info
/* 	The following time variables are in milliseconds.
	If you see a flicker of a background photo after
	a transition then you may want to increase the
	flicker time.  You can also play with the other
	time variables if animation is not smooth. */
$flicker_time = 500; // ms between photo operations
$opacity_time = 400; // ms between opacity
$trans_time = 32; // ms between transition steps
$effect_time = 32; // ms between effect steps

/*	You may also specify transitions, effects, and time in JPG Exif 
	comments. If you specify these then they override the default settings
	above.  The format is similar to a combination of HTML and Javascript.
	Just add the code to a JPG Photo comment and that photo will
	be effected by the code.
	Examples:
	<trans=crossfade> <effect=zoomin(center)> <time=5>
	
	time is the amount of seconds to display a photo.  Anything else you
	have in the description including HTML markups will display in the
	caption box if you have captions turned on above.
*/


/* DO NOT CHANGE ANY VARIABLES BELOW */

$error = ''; // Log errors for when we get to javascript

//This function gets the file names of all images in the current directory
//and ouputs them as a JavaScript array
function returnimages() 
{
	global $folder, $photosize, $get_exif, $error;
	$self = $_SERVER['SCRIPT_NAME']; // current file and path (Ex: /images/readimages.php)
	$uri = $_SERVER['REQUEST_URI']; // (Ex: /images/readimages.php?width=640)
	$query = $_SERVER['QUERY_STRING']; // (Ex: width=640)
	$pattern="/(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)/i"; //valid image extensions
	$exifpattern="/(\.jpg$)|(\.jpeg$)/i";  // valid exif jpg extensions
	//$files = array();
	$curimage=0;
	$comments=''; 
	$title='';

	if($handle = opendir($folder)) 
	{

		while(false !== ($file = readdir($handle)))
		{
			if(preg_match($pattern, $file)) //if this file is a valid image
			{ 
				if(preg_match($exifpattern, $file))
				if(function_exists('exif_read_data') && $get_exif==1)
				{	
					$exif = exif_read_data($folder.$file, 0, true);
					//echo "<BR>".$file."<br />\n";
					$title = $exif['WINXP']['Title']; // Comes from windows
					$comments = $exif['WINXP']['Comments']; // Comes from windows
					if ($comments == '') // if empty 
					 	$comments = $exif['COMMENT']['0']; // comes from jpg comment
					/*echo "Title:".$exif['IFD0']['Title']."<BR>"; // Comes from windows
					echo "Comments:".$exif['IFD0']['Comments']."<BR>"; // Comes from windows
					echo "COMMENT.0:".$exif['COMMENT']['0']."<BR>"; // comes from jpg comment */
       			} // end if function exists

				
				$temp2 = preg_replace("/<trans[^>]*>/is", "", $comments);
				$temp2 = preg_replace("/<effect[^>]*>/is", "", $temp2);
				$temp2 = preg_replace("/<title[^>]*>/is", "", $temp2);
				$temp2 = preg_replace("/<time[^>]*>/is", "", $temp2);
				
				//Output it as a JavaScript array element
				//echo '<TEXTAREA COLS="65" ROWS="4">';
				echo 'pictures['.$curimage.'] = {	photo: new Image, '.chr(13).
		  				'description: "'.addslashes($comments).'", '.chr(13).
						'caption: "'.addslashes($temp2).'", '.chr(13).
						'trans: "", '.chr(13).
						'effect: "", '.chr(13).
						'time: "", '.chr(13).
						'title: "'.addslashes($title).'"};'.chr(13); 
				//echo '</TEXTAREA>';
			// Not sure but I may need to urlencode $folder and $file ?? Is this true?
			echo 'pictures['.$curimage.'].photo.src="'.$self.'?image='.$folder.$file.'&width='.$photosize.'";'.chr(13);
			// Vlad wanted the statement below to load images directly without using php:
			//echo 'pictures['.$curimage.'].photo.src="'.$folder.$file.'";'.chr(13);

			$curimage++;
		}
	}
				if ($get_exif==1) // Bug fix 3/29/10 - Did not have this if statement before v. 1.2e
				if(!function_exists('exif_read_data'))
				{
					$error .= "Your server does not have EXIF Enabled.".
								" Please change '\$get_exif=0' instead of 1.";
				}
	closedir($handle);
	}
//return($files);
}  // end function returnimages();


function display_image($image_file, $photosize)  // Outputs a dynamically resized image
{
	global $quality;
	
		/* 	All these caching image Header settings seem to do nothing if IE is set to:
		Tools -> Internet Options -> Settings -> "Every visit to the page".
		But the slideshow runs smoothly without any headers also if IE is set to:
		Tools -> Internet Options -> Settings -> "Automatically".
		*/
		/* Bug Fix: 2/22/10 - As noted by Vlad M. I needed to move these headers to the top
		of the function for them to cache correctly, because all headers need to be before
		output such as the imagejpg or imagegif function. Still working on content-length...
		*/
	$offset = 60*60*24*30; // one month to cache
	//Header('Content-Length: '. $size);
	Header('Cache-Control: public, max.age='.$offset);
	Header('Expires: '. gmdate('D, d M Y H:i:s', time() + $offset) .' GMT');
	Header('Pragma: cache');
	Header('Cache-Control: post-check=3600,pre-check=43200');

	
	if (!$photosize)  	// if no width defined	
		$photosize = 150;	// then make our own width
		
	// Actual Image Dimensions
	$actual_size = GetImageSize($image_file);
	$actual_width = $actual_size[0];
	$actual_height = $actual_size[1];
	
	// calculate new width and height and preserve aspect ratio
	if ($actual_width > $photosize)
	{
		$perc = $actual_width / $photosize; // this preserves aspect ratio
		$new_width = floor($actual_width / $perc);
		$new_height = floor($actual_height / $perc);
	}
	else if ($actual_width <= $photosize) // Bug fix 4/14/09
	{
		// previously I was not even setting $new_width and $new_height
		// if $actual_width was smaller than $photosize
		$new_width = $actual_width;
		$new_height = $actual_height;
	}
			
	if($actual_size['mime'] == 'image/jpeg')
	{
		$img = imagecreatefromjpeg($image_file);
		$new_img = imagecreatetruecolor($new_width, $new_height);
		// copy old $img into $new_img with new width and height
		imagecopyresampled($new_img, $img, 0, 0, 0, 0, 
		$new_width, $new_height, $actual_width, $actual_height);
	
		
		Header("Content-type: image/jpeg");
		imagejpeg($new_img,'', $quality);  // image, filename or none, quality
	}
	else if($actual_size['mime'] == 'image/png')
	{
		$img = imagecreatefrompng($image_file);
		$new_img = imagecreatetruecolor($new_width, $new_height);
		// copy old $img into $new_img with new width and height
		imagecopyresampled($new_img, $img, 0, 0, 0, 0, 
		$new_width, $new_height, $actual_width, $actual_height);
		

		Header("Content-type: image/png");
		imagepng($new_img,'', $quality);  // image, filename or none, quality
	}
	else if($actual_size['mime'] == 'image/gif')
	{
		$img = imagecreatefromgif($image_file);  // Bug fix 4/14/09 Accidently had imagecreatefrom png here
		$new_img = imagecreatetruecolor($new_width, $new_height);
		// copy old $img into $new_img with new width and height
		imagecopyresampled($new_img, $img, 0, 0, 0, 0, 
		$new_width, $new_height, $actual_width, $actual_height);
				
		
		Header("Content-type: image/gif");
		imagegif($new_img,'', $quality);  // image, filename or none, quality
	}



	imagedestroy($img);
	imagedestroy($new_img);
		
}  // end function display_image()

if (isset($_GET['image']))
{
	$image_file = $_GET['image'];
	$photosize = (!isset($_GET['width'])) ? 150 : $_GET['width'];
	display_image($image_file, $photosize); // if this is a photo source then just display image
	exit();  // and then exit
}

Header("content-type: application/x-javascript");
	if ($error != '') // if there is an error than print it.
	{
        addslashes($error);
        echo 'document.write("<P>Error: '.$error.'");'.chr(13);
    }
//echo '<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript">';
echo 'var pictures=new Array();'.chr(13); //Define array in JavaScript
returnimages(); //Output the array elements containing the image file names
echo 'var phwidth = '.$phwidth.';'.chr(13); // pictureholder width 
echo 'var phheight = '.$phheight.';'.chr(13); // pictureholder height
// pictureholder DIV also has the class 'pictureholder' so you can add CSS border etc.
echo 'var seconds = '.$seconds.';'.chr(13); // switch photos n seconds
echo 'var randomize_photos = '.$randomize_photos.';'.chr(13); // 0 = Do not randomize photos;' 1 = Randomize photos
echo 'var display_caption = '.$display_caption.';'.chr(13); // 0 = No caption;' 1 = Display Picasa Description below photo
echo 'var caption_height = '.$caption_height.';'.chr(13); // How many pixels high for caption box if on
echo 'var caption_border = '.$caption_border.';'.chr(13); // Caption border pixels
// captionholder DIV has the class 'captionholder' so you can add CSS
echo 'var pan_zoom = '.$pan_zoom.';'.chr(13);  // how many times to zoom before panning
echo 'var trans = "'.$trans.'";'.chr(13); // default transition between photos
echo 'var effect = "'.$effect.'";'.chr(13); // default effect on photos

echo 'var cur_pic = '.$cur_pic.';'.chr(13); // which photo to start with. 0 is first photo in album.
echo 'var trans_amount = '.$trans_amount.';'.chr(13); // amount of steps for transitions
echo 'var effect_amount = '.$effect_amount.';'.chr(13); // amount of steps for effects
echo 'var testing_mode = '.$testing_mode.';'.chr(13); // 0 = off;' 1 = on;' testing mode creates a DIV with ID testing to display testing info

echo 'var flicker_time = '.$flicker_time.';'.chr(13); // ms between photo operations
echo 'var opacity_time = '.$opacity_time.';'.chr(13); // ms between opacity
echo 'var trans_time = '.$trans_time.';'.chr(13); // ms between transition steps
echo 'var effect_time = '.$effect_time.';'.chr(13); // ms between effect steps


//echo '</SCRIPT>';
?> 


//<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript">


/* DO NOT CHANGE ANY VARIABLES BELOW */
var ie = (document.all) // ie 5 or higher
var picture = "picture";
var picture2 = "picture2";  // Needed so Firefox and Netscape don't have javascript console errors
var pwidth;
var pheight;
var zwidth;
var zheight;
var ztimer; // timer for zoom effect
var zxstep; // zoom effect xstep
var zystep; // zoom effect ystep
var zleft = 0;
var ztop = 0;
var cleft = 0;  // to center photo
var ctop = 0; // to center photo 


function none(amount, none)
{
	// just a silly function to prevent an error for having effect none
	if (none == '1') // Means no transition
		setTimeout('changepic();', pictures[cur_pic].time);
} // end function none(amount)


function loadpics()
{
	
	if (randomize_photos == 1)
		shuffle_photos(); // shuffle or randomize photos
	
	setup_functions();
		
	init_show();

}  // function loadpics()


function init_show()
{
	// Create a loading progress bar in pictureholder
	document.getElementById('pictureholder').innerHTML = '<div style="text-align: center;'+
		'position: absolute; vertical-align: middle; font-size: 1.5em; width: 100%;">' +
		'LOADING'+
		'<span id="bar"></span></div>';
	// load 5 photos complete or pictures.length complete,  whichever is smaller
	for (i = 0; i < pictures.length && i < 5; i++)
	{	
		pcomplete = pictures[i].photo.complete;
		if (pcomplete)
		document.getElementById('bar').innerHTML = '<hr width="'
			+((phwidth/5)*i)+'" size="12" noshade="noshade" />'; 
	}

	if (!pcomplete)
	{
		setTimeout("init_show()", 10);
		return;
	}
	
	// Now create the IMG picture and picture2 inside the pictureholder DIV
	document.getElementById('pictureholder').innerHTML='<img id="picture" class="picture"'+
		' style="top: 0px; left: 0px; overflow:hidden; position:absolute;">'+
		'<img id="picture2" class="picture"'+
		' style="top: 0px; left: 0px; overflow:hidden; position:absolute;">';
		
	// make sure picture is 100% opaque
	set_opacity('picture', 0);

	// set opacity of picture2 to invisible
	set_opacity('picture2',0);
	
	document.getElementById('picture2').src = pictures[cur_pic].photo.src;
		document.getElementById('picture2').width = pictures[cur_pic].photo.width;
			document.getElementById('picture2').height = pictures[cur_pic].photo.height;
				document.getElementById('picture2').style.left = 0 + 'px';
					document.getElementById('picture2').style.top = 0 + 'px';
	center_image('picture2');
	
	// Call effectsetup for first photo
	effectsetup();
	
	// call function transition in duration 'seconds'
	setTimeout(pictures[cur_pic].trans, 0);
	
	//changepic();
		
} // end function init_show()


function center_image(obj)
{
	// since we have to make absolute positioned images
	// in order to display images on top of each other
	// for transition effects, we need to find a way
	// to place the next image on the center of
	// pictureholder
	cwidth = parseFloat(pictures[cur_pic].photo.width);
	cheight = parseFloat(pictures[cur_pic].photo.height);
	cleft = (phwidth - cwidth) / 2;
	ctop = (phheight - cheight) / 2;

	document.getElementById(obj).style.left = cleft + 'px';

	document.getElementById(obj).style.top = ctop + 'px';	
	
	//testingbox.innerHTML = cwidth+", "+cheight;

} // end function center_image()


function shuffle_photos()
{
	pictures.sort(function() 
	{
	return 0.5 - Math.random()
	}) //Array elements now scrambled
	
}  // end function shuffle()


function randomize_trans(i)
{
	rand = Math.floor(Math.random()*4) // 0 to 3
	
	if (rand == 0)
		ftype = "crossfade";
	if (rand == 1)
		ftype = "wipe";
	if (rand == 2)
		ftype = "slide";
	if (rand == 3)
		ftype = "zoom";	
		
	if (ftype == "wipe")
	 	rand = Math.floor(Math.random()*5) // 0 to 4
	else
		rand = Math.floor(Math.random()*9) // 0 to 8
	
	if (rand == 0)
		foption = "left";
	if (rand == 1)
		foption = "right";		
	if (rand == 2)
		foption = "top";
	if (rand == 3)
		foption = "bottom";
	if (rand == 4)
		foption = "center";
	if (rand == 5)
		foption = "upperright";
	if (rand == 6)
		foption = "lowerleft";
	if (rand == 7)
		foption = "lowerright";
	if (rand == 8)
		foption = "upperleft";	
		
	if (ftype == "slide" && rand == 4) // can't slide from the center
		foption = "left";

	if (ftype == "crossfade")
		pictures[i].trans = "crossfade(0);";
	else	
		pictures[i].trans = ftype+"(0, '"+foption+"')"; // slide(0, 'left');	
	
				
} // end function randomize_trans(i)


function randomize_effect(i)
{
	rand = Math.floor(Math.random()*4) // 0 to 3
	
	if (rand == 0)
		ftype = "none";
	if (rand == 1)
		ftype = "zoomin";
	if (rand == 2)
		ftype = "zoomout";
	if (rand == 3)
		ftype = "pan";	
		
	//ftype = "pan";
	
	if (ftype == "pan")
	 	rand = Math.floor(Math.random()*8) // 0 to 7 (no center for pan)
	else
		rand = Math.floor(Math.random()*9) // 0 to 8
	
	if (rand == 0)
		foption = "left";
	if (rand == 1)
		foption = "right";		
	if (rand == 2)
		foption = "top";
	if (rand == 3)
		foption = "bottom";
	if (rand == 4)
		foption = "upperleft";
	if (rand == 5)
		foption = "upperright";
	if (rand == 6)
		foption = "lowerleft";
	if (rand == 7)
		foption = "lowerright";
	if (rand == 8)
		foption = "center";	
		

	if (ftype == "none")
		pictures[i].effect = ftype;
	else	
		pictures[i].effect = ftype+"(0, '"+foption+"')"; // zoomin(0, 'left');		
				
} // end function randomize_effect(i)


function setup_functions()
{
	
	if (trans == "none")
		trans = "none(1)";
	
	// first go through and fill effects and transitions with default
	for (i = 0; i < pictures.length; i++)
	{
		// TRANSITIONS
		if (trans == "random")
			randomize_trans(i);
		else	
		{
		ftype = trans.replace(/['">)']/gi, ""); // ex: slide(left
		foption = ftype.split('('); // ex: slide     /    left
		// Check to see if the user put a real function in trans
		if (eval('typeof('+foption[0]+')') == 'function')
			pictures[i].trans = foption[0]+"(0, '"+foption[1]+"');"; // slide(0, 'left');
		else 
			pictures[i].trans = 'crossfade(0)';  // else just put crossfade for trans
		}
		// EFFECTS
		if (effect == "random")
			randomize_effect(i);
		else
		{
		ftype = effect.replace(/['">)']/gi, ""); // ex: slide(left
		foption = ftype.split('('); // ex: slide     /    left
		// Check to see if the user put a real function in effect
		if (eval('typeof('+foption[0]+')') == 'function')
			pictures[i].effect = foption[0]+"(0, '"+foption[1]+"');";
		else 
			pictures[i].effect = 'none(0)';  // else just put none effect
		}
		pictures[i].time = seconds*1000; // convert seconds into milliseconds
		//pictures[i].title = ''; // Blank the title
		
	}
	
	// Now fill in effects and transitions from descriptions
	for (i = 0; i < pictures.length; i++) 
	{
		if (pictures[i].description)
		{
		functions = pictures[i].description.split('<'); // ex: <trans="slide('left')>
		for (f = 0; f < functions.length; f++)
		{
			functions[f] = functions[f].toLowerCase();
			ftype = functions[f].split('='); // ex: trans    /   "slide('left')>
			if (ftype[1])
			{
			ftype[1] = ftype[1].replace(/['")']/gi, ""); // ex: slide(left>
			ftype[1] = ftype[1].replace(/>[\s\S]*/gi, "");
			//ftype[1] = ftype[1].replace(/>/gi, "");
			foption = ftype[1].split('('); // ex: slide     /    left
			if (ftype[0] == "trans")
			{
						// v. 1.12 4/13/09 added random to trans
			if (foption[0] == 'random') 
				randomize_trans(i);
			// Check to see if the user put a real function in trans
			// v. 1.11 4/13/09 switch from if (eval('typeof('+foption[0]+')') == 'function')
			if ((foption[0] == 'none' || foption[0] == 'crossfade' 
					|| foption[0] == 'zoom' || foption[0] == 'wipe' || foption[0] == 'slide')
					&& (foption[1] == 'upperleft' || foption[1] == 'top' || foption[1] == 'upperright'
					|| foption[1] == 'left' || foption[1] == 'center' || foption[1] == 'right'
					|| foption[1] == 'lowerleft' || foption[1] == 'bottom' || foption[1] == 'lowerright'))
				pictures[i].trans = foption[0]+"(0, '"+foption[1]+"')"; // slide(0, 'left');
			}	
			else if (ftype[0] == "effect")
			{	
			// v. 1.12 4/13/09 added random to effect
			if (foption[0] == 'random') 
				randomize_effect(i);
			// Check to see if the user put a real function in trans
			// v. 1.11 4/13/09 switch from if (eval('typeof('+foption[0]+')') == 'function'
			if ((foption[0] == 'none' || foption[0] == 'zoomin' 
					|| foption[0] == 'zoomout' || foption[0] == 'pan')
					&& (foption[1] == 'upperleft' || foption[1] == 'top' || foption[1] == 'upperright'
					|| foption[1] == 'left' || foption[1] == 'center' || foption[1] == 'right'
					|| foption[1] == 'lowerleft' || foption[1] == 'bottom' || foption[1] == 'lowerright'))
				pictures[i].effect = foption[0]+"(0, '"+foption[1]+"')";
			}
			else if (ftype[0] == "time")
			{	
				// convert seconds into milliseconds
				pictures[i].time = parseFloat(foption[0])*1000;
			}
			else if (ftype[0] == "title")
			{	
				pictures[i].title = ftype[0];
			}
			} // end if (ftype[1])
		} // end for
		} // end if pictures[i].description
	}	
	
	// Print to screen
	//for (i = 0; i < pictures.length; i++) 
		//document.write(i+". Transition: "+pictures[i].trans+". Effect: "+pictures[i].effect+"<BR>");
				

} // end function setup_functions()



function set_opacity(object, level)
{
	// The "object" is usally picture, picture2
	// or photo or photo2
	// the level is 0 (transparent) to 100 (opaque)
	if(ie)
	{
        // first create a filter
		document.getElementById(object).style.filter="alpha(opacity="+level+")";
		// then set the opacity
		//document.getElementById(object).filters.alpha.opacity = level;
    }
    else  // mozilla or netscape
	{
		// Netscape has a bug where it flickers at 100% opacity
		// so we will change 100 to 99.999%
		if (level == 100)
			level = 99.999;
		// set the opacity for firefox and netscape
		document.getElementById(object).style.MozOpacity = level/100;
    	// set the opacity for safari prior to 1.2
    	document.getElementById(object).style.KHTMLOpacity = level/100;
		// set the opacity for safari 1.2 and higher and newer firefox
		document.getElementById(object).style.opacity = level/100;
	}

} // end function set_opacity


function crossfade(opacity) 
{

  	
  if (document.getElementById) 
  {

	if (opacity <= 100) 
	{
      set_opacity('picture2', opacity);
      set_opacity('picture', 100 - opacity);
      opacity += 10;
      window.setTimeout("crossfade("+opacity+")", trans_time);
    
	}
    else
    {
    	// I had to put half the seconds here and load the image
    	// early in order to prevent a flicker in IE when
    	// on a web server
		//center_image('picture2');
		//document.getElementById('picture').src = pictures[cur_pic].photo.src;
		setTimeout('changepic();', trans_time);

    }
  }
} // end function crossfade(objID, opacity)


function wipe(amount, from)
{
	pwidth = document.getElementById('picture2').width;
	pheight = document.getElementById('picture2').height;
	xstep = pwidth / trans_amount * amount;
	ystep = pheight / trans_amount * amount;
	 
	
	if (from == "left")
	{
		// clip by rect(top, right, bottom, left)
		document.getElementById('picture2').style.clip = 'rect(' +
		'0px, ' + 
		Math.round(0+xstep) + 'px, ' +
		pheight + 'px, ' + 
		'0px)';
	}
	else if (from == "right")
	{
		// clip by rect(top, right, bottom, left)
		document.getElementById('picture2').style.clip = 'rect(' +
		'0px, ' + 
		pwidth + 'px, ' +
		pheight + 'px, ' + 
		Math.round(pwidth-xstep) + 'px)';
	}
	else if (from == "top")
	{
		// clip by rect(top, right, bottom, left)
		document.getElementById('picture2').style.clip = 'rect(' +
		'0px, ' + 
		pwidth + 'px, ' +
		Math.round(ystep) + 'px, ' + 
		'0px)';
	}
	else if (from == "bottom")
	{
		// clip by rect(top, right, bottom, left)
		document.getElementById('picture2').style.clip = 'rect(' +
		Math.round(pheight-ystep) + 'px, ' + 
		pwidth + 'px, ' +
		pheight + 'px, ' + 
		'0px)';
	}
	else  // if center or none specified
	{
		xcenter = pwidth / 2; // so 640 / 2 = 320
		ycenter = pheight / 2; // so 480 / 2 = 240
		xstep = xcenter / trans_amount * amount;
		ystep = ycenter / trans_amount * amount;
		
		// clip by rect(top, right, bottom, left)
		document.getElementById('picture2').style.clip = 'rect(' +
		Math.round(ycenter-ystep) + 'px, ' + 
		Math.round(xcenter+xstep) + 'px, ' +
		Math.round(ycenter+ystep) + 'px, ' + 
		Math.round(xcenter-xstep) + 'px)';
	}
	
	if (amount == 1)
		set_opacity('picture2', 100);
	
	amount++;
	
	if (amount < trans_amount)
		window.setTimeout("wipe("+amount+", '"+from+"');", trans_time);
	else
    {
    	// reset clip
    	document.getElementById('picture2').style.clip = 'rect(auto, auto, auto, auto)';
		// I had to put half the seconds here and load the image
    	// early in order to prevent a flicker in IE when
    	// on a web server
		//document.getElementById('picture').src = pictures[cur_pic].photo.src;
    	setTimeout('changepic();', trans_time);

    }

} // end function wipe(amount, from)


function zoomin(amount, to) // this function is a photo effect
{
	
	if (amount == 0)
	{
		zwidth = document.getElementById('picture').width;
		zheight = document.getElementById('picture').height;
		//testing.innerHTML = zwidth+", "+zheight;
		// Calculate slope.
		// Steps will be 1 each unless width is bigger than height
		// or height is bigger than width.  If that is the case
		// then the step for the bigger dimension will be the slope (ex: zwidth / zheight)
		// the 2 and the *2 is to make each step twice as big
		zxstep = 3;
		zystep = 3;
		if (zwidth > zheight)
			zxstep = (zwidth / zheight)*3;
		if (zheight > zwidth)
			zystep = (zheight / zwidth)*3;
	} 
	
	zwidth = zwidth + zxstep;
	zheight = zheight + zystep;
	
	//document.getElementById('testing').innerHTML = "xstep="+zxstep+", ystep="+zystep;
	

	document.getElementById('picture').width = zwidth;
	document.getElementById('picture').height = zheight;
	
	
	
	zzleft = parseFloat(document.getElementById('picture').style.left);
	zztop = parseFloat(document.getElementById('picture').style.top);
	
	//document.getElementById('testing').innerHTML = "left="+zleft+", top="+ztop;
	
	// Untouched is upperleft
	
	if (to == "upperright" || to == "right" || to == "lowerright")
		document.getElementById('picture').style.left = zzleft - zxstep + 'px';
	
	if (to == "top" || to == "bottom" || to == "center")
		document.getElementById('picture').style.left = zzleft - zxstep/2 + 'px';
	
	if (to == "lowerleft" || to == "bottom" || to == "lowerright")	
		document.getElementById('picture').style.top = zztop - zystep + 'px';
			
	if (to == "left" || to == "center" || to == "right")
		document.getElementById('picture').style.top = zztop - zystep/2 + 'px';
		
	amount++;
	
	//if (amount == 30) alert('hi');
	
	if (amount <= effect_amount)
		ztimer = window.setTimeout("zoomin("+amount+", '"+to+"');", effect_time);
	else
	{
		// reset left and top of picture
			//document.getElementById('picture').style.left = 0;
			//document.getElementById('picture').style.top = 0;
	}
	
} // end function zoomin(amount, to)



function effectsetup()
{
	
	//testing.innerHTML = document.getElementById('picture2').width+", "+
	//	document.getElementById('picture2').height;
	//testing.innerHTML += ". "+pictures[cur_pic].photo.width+", "+pictures[cur_pic].photo.height;
	
	ftype = pictures[cur_pic].effect.replace(/['">);']/gi, ""); // ex: slide(left
	foption = ftype.split('(0, '); // ex: slide     /    left
	
	if (foption[1])
		to = foption[1];
	else
		to = "";
	
	
	if (foption[0] == "zoomout")
	{
		document.getElementById('picture2').width = parseFloat(document.getElementById('picture2').width*2);
		document.getElementById('picture2').height = parseFloat(document.getElementById('picture2').height*2);
	
		// center enlarged image
		cwidth = parseFloat(document.getElementById('picture2').width*2);
		cheight = parseFloat(document.getElementById('picture2').height*2);
		ztop = 0;
		zleft = 0;
		
		// no to is upperleft
		
		if (to == "upperright" || to == "right" || to == "lowerright")
			zleft = (cwidth/4) * -1; // to get negative of the positive number
		
		if (to == "top" || to == "bottom" || to == "center")
			zleft = (cwidth/8) * -1;	
		
		if (to == "lowerleft" || to == "bottom" || to == "lowerright")
			ztop = (cheight/4) * -1;
		
		if (to == "left" || to == "center" || to == "right")	
			ztop = (cheight/8) * -1; 
			
			
		cleft = cleft + zleft;
		ctop = ctop + ztop;
		
		document.getElementById('picture2').style.top = ctop + 'px';
		document.getElementById('picture2').style.left = cleft + 'px';
		
		ztop = ctop;
		zleft = cleft;
		
	} // end if zoomout
	
	if (foption[0] == "pan")
	{
		document.getElementById('picture2').width = parseFloat(document.getElementById('picture2').width*pan_zoom);
		document.getElementById('picture2').height = parseFloat(document.getElementById('picture2').height*pan_zoom);
	
		// center enlarged image
		cwidth = parseFloat(document.getElementById('picture2').width*pan_zoom);
		cheight = parseFloat(document.getElementById('picture2').height*pan_zoom);
		ztop = 0;
		zleft = 0;
		
		// no to is upperleft
		
		if (to == "upperright" || to == "right" || to == "lowerright")
			zleft = (cwidth/4) * -1; // to get negative of the positive number
		
		if (to == "top" || to == "bottom" || to == "center")
			zleft = (cwidth/8) * -1;	
		
		if (to == "lowerleft" || to == "bottom" || to == "lowerright")
			ztop = (cheight/4) * -1;
		
		if (to == "left" || to == "center" || to == "right")	
			ztop = (cheight/8) * -1; 
			
			
		cleft = cleft + zleft;
		ctop = ctop + ztop;
		
		document.getElementById('picture2').style.top = ctop + 'px';
		document.getElementById('picture2').style.left = cleft + 'px';
		
		ztop = ctop;
		zleft = cleft;
		
	} // end if pan
	

} // end function effectsetup()


function zoomout(amount, to) // this function is a photo effect
{
		
	if (amount == 0)
	{
		//zwidth = document.getElementById('picture').width;
		//zheight = document.getElementById('picture').height;
		//zwidth = pictures[cur_pic].photo.width*2;
		//zheight = pictures[cur_pic].photo.height*2;
		
		// center enlarged image
		zwidth = parseFloat(document.getElementById('picture').width*2);
		zheight = parseFloat(document.getElementById('picture').height*2);

		
		//zleft = (phwidth - zwidth) / 2;
		//document.getElementById('picture').style.left = zleft;
		
		/*
		//if (to == "upperright" || to == "right" || to == "lowerright")
			zleft = (zwidth/2) * -1; // to get negative of the positive number
		
		if (to == "top" || to == "bottom" || to == "center")
			zleft = (zwidth/4) * -1;	
		
		//if (to == "lowerleft" || to == "bottom" || to == "lowerright")
			ztop = (zheight/2) * -1;
		
		if (to == "left" || to == "center" || to == "right")	
			ztop = (zheight/4) * -1;
		*/
	
		document.getElementById('picture').style.top = ztop + 'px';
		document.getElementById('picture').style.left = zleft + 'px'; 
		//ztop = ctop;
		//zleft = cleft;
		
			//testingbox.innerHTML = zwidth+', '+zheight+", "+to;
		//document.getElementById('testing').innerHTML = "width="+zwidth+", height="+zheight;
		// Calculate slope.
		// Steps will be 3 each unless width is bigger than height
		// or height is bigger than width.  If that is the case
		// then the step for the bigger dimension will be the slope (ex: zwidth / zheight)*3
		// the 3 and the *3 is to make each step twice as big
		zxstep = 3;
		zystep = 3;
		if (zwidth > zheight)
			zxstep = (zwidth / zheight)*3;
		if (zheight > zwidth)
			zystep = (zheight / zwidth)*3;	
		//document.getElementById('picture').width = zwidth*2;
		//document.getElementById('picture').height = zheight*2;	
	} 
	
	zwidth = zwidth - zxstep;
	zheight = zheight - zystep;
	

	document.getElementById('picture').width = zwidth;
	document.getElementById('picture').height = zheight;

	zzleft = parseFloat(document.getElementById('picture').style.left);
	zztop = parseFloat(document.getElementById('picture').style.top);
	//testingbox.innerHTML = zzleft+', '+zztop;
	
	// Untouched is upperleft
	
	if (to == "upperright" || to == "right" || to == "lowerright")
		document.getElementById('picture').style.left = zzleft + zxstep + 'px';
	
	if (to == "top" || to == "bottom" || to == "center")
		document.getElementById('picture').style.left = zzleft + zxstep/2 + 'px';
	
	if (to == "lowerleft" || to == "bottom" || to == "lowerright")	
		document.getElementById('picture').style.top = zztop + zystep + 'px';
			
	if (to == "left" || to == "center" || to == "right")
		document.getElementById('picture').style.top = zztop + zystep/2 + 'px';
		
	amount++;
	
	
	//if (amount == 30) alert('hi');
	
	if (amount <= effect_amount)
		ztimer = window.setTimeout("zoomout("+amount+", '"+to+"');", effect_time);
	else
	{
		
		// reset left and top of picture
		//document.getElementById('picture').style.left = 0;
		//document.getElementById('picture').style.top = 0;
		//center_image('picture');
	}
	
} // end function zoomout(amount, to)


function pan(amount, to) // This is a photo effect
{
	if (amount == 0)
	{
		//zwidth = document.getElementById('picture').width;
		//zheight = document.getElementById('picture').height;
		//zwidth = pictures[cur_pic].photo.width*2;
		//zheight = pictures[cur_pic].photo.height*2;
		
		// center enlarged image
		zwidth = parseFloat(document.getElementById('picture').width*pan_zoom);
		zheight = parseFloat(document.getElementById('picture').height*pan_zoom);
		document.getElementById('picture').width = zwidth;
		document.getElementById('picture').height = zheight;
		
		//zleft = (phwidth - zwidth) / 2;
		//document.getElementById('picture').style.left = zleft;
		
		/*
		//if (to == "upperright" || to == "right" || to == "lowerright")
			zleft = (zwidth/2) * -1; // to get negative of the positive number
		
		if (to == "top" || to == "bottom" || to == "center")
			zleft = (zwidth/4) * -1;	
		
		//if (to == "lowerleft" || to == "bottom" || to == "lowerright")
			ztop = (zheight/2) * -1;
		
		if (to == "left" || to == "center" || to == "right")	
			ztop = (zheight/4) * -1;
		*/
	
		document.getElementById('picture').style.top = ztop + 'px';
		document.getElementById('picture').style.left = zleft + 'px'; 
		//ztop = ctop;
		//zleft = cleft;
		
			//testingbox.innerHTML = zwidth+', '+zheight+", "+to;
		//document.getElementById('testing').innerHTML = "width="+zwidth+", height="+zheight;
		// Calculate slope.
		// Steps will be 3 each unless width is bigger than height
		// or height is bigger than width.  If that is the case
		// then the step for the bigger dimension will be the slope (ex: zwidth / zheight)*3
		// the 2 and the *2 is to make each step twice as big
		zxstep = 1;
		zystep = 1;
		if (zwidth > zheight)
			zxstep = (zwidth / zheight);
		if (zheight > zwidth)
			zystep = (zheight / zwidth);	
		//document.getElementById('picture').width = zwidth*2;
		//document.getElementById('picture').height = zheight*2;	
	} 
	
	/*zwidth = zwidth - zxstep;
	zheight = zheight - zystep;
	 */

	zzleft = parseFloat(document.getElementById('picture').style.left);
	zztop = parseFloat(document.getElementById('picture').style.top);
	//testingbox.innerHTML = zzleft+', '+zztop;
	
	// There is no center in pan
	
	if (to == "upperright" || to == "right" || to == "lowerright")
		document.getElementById('picture').style.left = zzleft + zxstep + 'px';
	
	if (to == "upperleft" || to == "left" || to == "lowerleft")
		document.getElementById('picture').style.left = zzleft - zxstep + 'px';
	
	if (to == "lowerleft" || to == "bottom" || to == "lowerright")	
		document.getElementById('picture').style.top = zztop + zystep + 'px';
			
	if (to == "upperleft" || to == "top" || to == "upperright")
		document.getElementById('picture').style.top = zztop - zystep + 'px';
		
	amount++;
	
	
	//if (amount == 30) alert('hi');
	
	if (amount <= effect_amount)
		ztimer = window.setTimeout("pan("+amount+", '"+to+"');", effect_time);

} // end function pan(amount, from)


function zoom(amount, from) // This function is a transition
{

	pcomplete = document.getElementById('picture2').complete;
	// i need the if statement below for mozilla firefox
	// browsers and netscape browsers.  They don't know
	// the width of the height of an image until it 
	// completes loading, so I can't zoom in at the
	// correct size.  (It sets size to 24x24).  So I use
	// the .complete element to see if the photo has loaded.
	if (!pcomplete) // if photo hasn't finished loading
	{
		// call this function again in 100ms
		// to see if the photo completes loading
		setTimeout('zoom(0,"'+from+'")', 100);
		return; // exit this function
	}
	
	if (amount == 0)
	{
		pwidth = document.getElementById('picture2').width;
		pheight = document.getElementById('picture2').height;
		//pwidth = pictures[cur_pic].photo.width;
		//pheight = pictures[cur_pic].photo.height;
		set_opacity('picture2', 100);
	}	
	
	//document.getElementById('testing').innerHTML = "width="+pwidth+", height="+pheight;
	
	xstep = pwidth / trans_amount * amount;
	ystep = pheight / trans_amount * amount;
 		

	document.getElementById('picture2').width = xstep;
	document.getElementById('picture2').height = ystep;

	// uppperleft is not moving the top or left at all
	
	if (from == "left" || from == "center" || from == "right")
		document.getElementById('picture2').style.top = (pheight+ctop) / 2 - (ystep-ctop) / 2 + 'px';
	
	if (from == "top" || from == "center" || from =="bottom")
		document.getElementById('picture2').style.left = (pwidth+cleft) / 2 - (xstep-cleft) / 2 + 'px';
	
	if (from == "lowerleft" || from == "lowerright" || from=="bottom")
		document.getElementById('picture2').style.top = (pheight+ctop) - ystep + 'px';
		
	if (from == "upperright" || from == "lowerright" || from=="right")
		document.getElementById('picture2').style.left = (pwidth+cleft) - xstep + 'px';
		
	amount++;
	
	if (amount <= trans_amount)
		window.setTimeout("zoom("+amount+", '"+from+"');", trans_time);
	else
    {

		// I had to put half the seconds here and load the image
    	// early in order to prevent a flicker in IE when
    	// on a web server
		//center_image('picture');
		//document.getElementById('picture').src = pictures[cur_pic].photo.src;
		setTimeout('changepic();', trans_time);

    }
	
} // end function zoom(amount, from)


function slide(amount, from)
{
	pwidth = document.getElementById('picture2').width;
	pheight = document.getElementById('picture2').height;
	

	if (from == null || from == 'undefined')
		from = 'left';
	
	//document.getElementById('testing').innerHTML = "Hi "+amount+", "+from;
	
	if (from == "left" || from == "lowerleft" || from == "upperleft")
	{
		xstep = Math.round((pwidth+cleft) / trans_amount * amount);
		xstep = pwidth - (pwidth*2) + xstep;
		//document.getElementById('testing').innerHTML = xstep;
		document.getElementById('picture2').style.left = xstep + 'px';
	}
	else if (from == "right" || from == "lowerright" || from == "upperright")
	{
		xstep = Math.round((pwidth-cleft) / trans_amount * amount);
		xstep = pwidth - xstep;
		//document.getElementById('testing').innerHTML = xstep;
		document.getElementById('picture2').style.left = xstep + 'px';
	}
	
	if (from == "top" || from == "upperleft" || from == "upperright")
	{
		ystep = Math.round((pheight+ctop) / trans_amount * amount);
		ystep = pheight - (pheight*2) + ystep;
		//document.getElementById('testing').innerHTML = ystep;
		document.getElementById('picture2').style.top = ystep + 'px';
	}
	else if (from == "bottom" || from == "lowerleft" || from == "lowerright")
	{
		ystep = Math.round((pheight-ctop) / trans_amount * amount);
		ystep = pheight - ystep;
		//document.getElementById('testing').innerHTML = ystep;
		document.getElementById('picture2').style.top = ystep + 'px';
	}
	
	if (amount == 0)
		set_opacity('picture2', 100);
	
	amount++;
	
	if (amount <= trans_amount)
		window.setTimeout("slide("+amount+", '"+from+"');", trans_time);
	else
    {
		// I had to put half the seconds here and load the image
    	// early in order to prevent a flicker in IE when
    	// on a web server
		//document.getElementById('picture').src = pictures[cur_pic].photo.src;
		setTimeout('changepic();', trans_time);

    }	

}  // end function slide(0, from)


function next_pic()
{
	cur_pic++;  // advance to next picture
		
	if (cur_pic == pictures.length)
	{
		cur_pic = 0;
		if (randomize_photos == 1)
			shuffle_photos();	
		//setup_functions(); // to randomize the transitions and effects again
	}

} // end function next_pic()


function changepic()
{

	if (testing_mode == 1)
	testingbox.innerHTML = cur_pic+". Transition: "+pictures[cur_pic].trans+". Effect: "+pictures[cur_pic].effect+
	". Time: "+pictures[cur_pic].time+
	". Width:"+pictures[cur_pic].photo.width+", "+pictures[cur_pic].photo.height;
	
	var milliseconds = pictures[cur_pic].time;

	if (display_caption == 1) // display Picasa Description for current photo
		document.getElementById('captionholder').innerHTML = pictures[cur_pic].caption;
		
	clearTimeout(ztimer);
		
	document.getElementById('picture').src = pictures[cur_pic].photo.src;
		document.getElementById('picture').width = pictures[cur_pic].photo.width;
			document.getElementById('picture').height = pictures[cur_pic].photo.height;
				document.getElementById('picture').style.left = 0 + 'px';
					document.getElementById('picture').style.top = 0 + 'px';
				
	center_image('picture');
	
	// make sure picture is 100% opaque
	
	setTimeout("set_opacity('picture',100);", opacity_time)  // this is what causes the flicker in IE


	// set opacity of picture2 to invisible
	setTimeout("set_opacity('picture2',0);", opacity_time)  // this is what causes the flicker in IE
	
	// Call effect function
	//testing.innerHTML = eval('(typeof('+pictures[cur_pic].effect+'));'); // != "undefined");');
	//setTimeout('eval(pictures['+cur_pic+'].effect);', opacity_time);
	setTimeout(pictures[cur_pic].effect, opacity_time);
	
	//setTimeout('next_pic();', opacity_time);
	next_pic();

	// preload next image
	//  if (cur_pic < pictures_length)
	//	img.src = pictures[cur_pic].photo;
	//else
	//	img.src = pictures[0]; 
		
	// I had to put a settimeout here and load the image
    // later in order to prevent a flicker of the next photo 
    // in IE and sometimes firefox
	// put next photo in IMG with ID 'picture2' but it will be invisible
	
	
	setTimeout("document.getElementById('picture2').src = pictures["+cur_pic+"].photo.src;", flicker_time);
	setTimeout("document.getElementById('picture2').width = pictures["+cur_pic+"].photo.width;", flicker_time+20);
	setTimeout("document.getElementById('picture2').height = pictures["+cur_pic+"].photo.height;", flicker_time+20);
	setTimeout("document.getElementById('picture2').style.left = 0 + 'px';", flicker_time+20);
	setTimeout("document.getElementById('picture2').style.top = 0 + 'px';", flicker_time+20);
	
	setTimeout('center_image("picture2");', flicker_time+50);
	
	// testing for zoomout(0)
	setTimeout('effectsetup();', flicker_time+100);
				
	// call transition function in duration 'seconds'
	setTimeout('eval(pictures[cur_pic].trans)', milliseconds);  
	//window.setTimeout("zoom(0);", seconds);
	//window.setTimeout("zoom(0, 'upperright');", seconds);
	//window.setTimeout("wipe(0, 'bottom');", seconds);


	//window.setTimeout("slide(0, 'top');", seconds);

}  // end function changepic(direction)


// testing function to display_all images loaded from dynamically from php
function display_all()
{
	for (i = 0; i < pictures.length; i++)
	{
		document.write('<img src="'+pictures[i].photo.src+'"><br>');
		document.write(pictures[i].caption+'<br>');
	}

} // end function display_all()

	// first create a testing div to write messages
	if (testing_mode == 1)
	{
		document.write('<div id="testing"><br></div>');
		testingbox = document.getelementbyid('testing');
	}
	/* both fore and back pictures have to be positioned absolute */
	/* inside a relative div */
	/* both have classes, 'pictureholder' and 'picture' respectively */
	/* so you can create these classes and add borders or whatever */
	/* we create the relative img's in loadpics */
	
	// So first we create the relative DIV
	document.write('<div id="pictureholder" class="pictureholder"'+
		' style="width: '+phwidth+'px; height: '+phheight+'px; overflow: hidden; position: relative;">');
	// Close the pictureholder DIV
	document.write('</div>');
	// Make caption below pictureholder
	if (display_caption == 1)
	document.write('<div id="captionholder" class="captionholder"'+
		' style="width:'+phwidth+'px; height: '+caption_height+
		'px; border-width:'+caption_border+'px; border-style:solid;'+
		' margin-top: 5px; padding: 5px; text-align: center;"></div>');
	
// The line below calls the google feed and starts the loadpics function
// The line below starts the loadpics function
window.onload = loadpics; 


//display_all();

//</SCRIPT>




