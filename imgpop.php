<?php
// Yellow Copyright (c) 2013-2016 Datenstrom, http://datenstrom.se
// imgpop Copyright (c) 2016 Norbert Simon, http://www.nosi.de
// This file may be used and distributed under the terms of the public license.
// Autor: Norbert Simon

// Image popup with CSS-styles plugin
class YellowImgPop
{
	const Version = "0.0.5";
  const NoTitle = "Keine weitere Bildbeschreibung";
  const NoImg = "<b>Bildquelle fehlt</b>";
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
		if($name=="imgpop" && $shortcut)
		{
			list($TheImage, $TheTitle, $TheID, $TheClass) = $this->yellow->toolbox->getTextArgs($text);
      if(empty($TheID)) $TheID = time();
      if(empty($TheTitle)) $TheTitle = NoTitle;
      if(empty($TheImage)) 
       {
       $output = NoImg;  
     }
      else
      {
       $TheImage = $this->yellow->config->get("imageDir").$TheImage;
       $output = "<span id=\"" . $TheID . "\"";
       if(!empty($TheClass)) 
       {
         $output .= "class=\"" . $TheClass  . "\"";
       } 
       $output .= "><a id=\"" . $TheID . "close\" href=\"#" . $TheID . "\" title=\"" . htmlspecialchars($TheTitle) . "\">";
       $output .= "<img src=\"/" . $TheImage . "\" title=\"" . htmlspecialchars($TheTitle) . "\"></a>";
       $output .= "<span class=\"imgnote\">" . htmlspecialchars($TheTitle) . "</span>";
       $output .= "<a class=\"closer\" href=\"#" . $TheID . "close\">&otimes;</a>";
       $output .= "</span>"; 
      }
		}
		return $output;
	}
}

$yellow->plugins->register("imgpop", "YellowImgPop", YellowImgPop::Version);
?>