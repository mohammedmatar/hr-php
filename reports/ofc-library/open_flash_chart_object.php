<?php
function open_flash_chart_object( $width, $height, $url, $use_swfobject=true )
{
	//
    // I think we may use swfobject for all browsers,
    // not JUST for IE...
    //
    //$ie = strstr(getenv('HTTP_USER_AGENT'), 'MSIE');
    
    //
    // escape the & and stuff:
    //
    $url = urlencode($url);
    
    //
    // if there are more than one charts on the
    // page, give each a different ID
    //
    global $open_flash_chart_seqno;
    $obj_id = 'chart';
    $div_name = 'flashcontent';
    
    if( !isset( $open_flash_chart_seqno ) )
    {
        $open_flash_chart_seqno = 1;
        echo '<script type="text/javascript" src="js/swfobject.js"></script>';
    }
    else
    {
        $open_flash_chart_seqno++;
        $obj_id .= '_'. $open_flash_chart_seqno;
        $div_name .= '_'. $open_flash_chart_seqno;
    }
    
	if( $use_swfobject )
    {
		// Using library for auto-enabling Flash object on IE, disabled-Javascript proof
	    
        echo '<div id="'. $div_name .'"></div>';
    	
		echo '<script type="text/javascript">';
		echo 'var so = new SWFObject("open-flash-chart.swf", "ofc", "'. $width . '", "' . $height . '", "9", "#FFFFFF");';
		echo 'so.addVariable("width", "' . $width . '");';
		echo 'so.addVariable("height", "' . $height . '");';
		echo 'so.addVariable("data", "'. $url . '");';
		echo 'so.addParam("allowScriptAccess", "sameDomain");';
		echo 'so.write("'. $div_name .'");';
		echo '</script>';
		echo '<noscript>';
	}

	echo '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" ';
    echo 'width="' . $width . '" height="' . $height . '" id="ie_'. $obj_id .'" align="middle">';
	echo '<param name="allowScriptAccess" value="sameDomain" />';
	echo '<param name="movie" value="open-flash-chart.swf?width='. $width .'&height='. $height . '&data='. $url .'" />';
    echo '<param name="quality" value="high" />';
    echo '<param name="bgcolor" value="#FFFFFF" />';
	echo '<embed src="open-flash-chart.swf?data=' . $url .'" quality="high" bgcolor="#FFFFFF" width="'. $width .'" height="'. $height .'" name="open-flash-chart" align="middle" allowScriptAccess="sameDomain" ';
    echo 'type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" id="'. $obj_id .'"/>';
	echo '</object>';

	if ( $use_swfobject ) {
		echo '</noscript>';
	}
}
?>