<?php
// imgPop plugin, https://github.com/BsNoSi/yellow-plugin-imgpop
// imgpop Copyright (c) 2018 Norbert Simon, http://www.nosi.de
// Based on YELLOW Copyright (c) 2013-2018 Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.

class YellowImgPop
{
	const Version = "1.0.0";
  const NoTitle = "No Image Description";
  const NoImg = "<b style=\"color:#FF0000\">Image is missing!</b>";
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
      if(empty($TheTitle)) $TheTitle = self::NoTitle;
	  $TheClass = (empty($TheClass)) ? $TheClass = '' : $TheClass = ' class="' . $TheClass . '"';
	  	  
      if(empty($TheImage)) 
       {
       $output = self::NoImg;  
     }
      else
      {
       $TheImage = $this->yellow->config->get("imageDir").$TheImage;
       $output = '<span id="' . $TheID . '"' . $TheClass . '>';
       $output .= '<a id="' . $TheID . 'close" href="#' . $TheID . '" title="' . htmlspecialchars($TheTitle) . '">';
       $output .= '<img' . $TheClass . ' src="/' . $TheImage . '" title="' . htmlspecialchars($TheTitle) . '"></a>';
       $output .= '<span class="imgnote">' . htmlspecialchars($TheTitle) . '</span>';
       $output .= '<a class="closer" href="#' . $TheID . 'close">&otimes;</a>';
       $output .= '</span>'; 
      }
		}
		return $output;
	}
}
?>
