<?php
// Copyright (c) 2013-2015 Datenstrom, http://datenstrom.se
// This file may be used and distributed under the terms of the public license.
// Autor: Norbert Simon

// Image Scale with CSS-styles plugin
class YellowImgScale
{
	const Version = "0.0.1";
	var $yellow;			//access to API
	
	// Handle initialisation
	function onLoad($yellow)
	{
		$this->yellow = $yellow;
	}
	
	// Handle page content parsing of custom block
	function onParseContentBlock($page, $name, $text, $shortcut)
	{
		$output = NULL;
		if($name=="imgscale" && $shortcut)
		{
			list($TheImage, $TheTitle, $TheID) = $this->yellow->toolbox->getTextArgs($text);
      if(empty($TheID)) $TheID = time();
      if(empty($TheTitle)) $TheTitle = "Keine weitere Bildbeschreibung";
      if(empty($TheImage)) 
       {
       $output = "<b>Bildquelle fehlt</b>";  
     }
      else
      {
       $TheImage = $this->yellow->config->get("imageDir").$TheImage;
       $output = "<span id=\"" . $TheID . "\">";
       $output .= "<a id=\"" . $TheID . "close\" href=\"#" . $TheID . "\" title=\"" . htmlspecialchars($TheTitle) . "\">";
       $output .= "<img src=\"/" . $TheImage . "\" title=\"" . htmlspecialchars($TheTitle) . "\"></a>";
       $output .= "<span class=\"imgnote\">" . htmlspecialchars($TheTitle) . "</span>";
       $output .= "<a class=\"closer\" href=\"#" . $TheID . "close\">&otimes;</a>";
       $output .= "</span>"; 
      }
		}
		return $output;
	}
}

$yellow->plugins->register("imgscale", "Yellowimgscale", YellowimgScale::Version);
?>