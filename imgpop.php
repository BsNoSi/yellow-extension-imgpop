<?php
// imgPop plugin, https://github.com/BsNoSi/yellow-plugin-imgpop
// imgpop Copyright (c) 2018 Norbert Simon, http://www.nosi.de
// Based on YELLOW Copyright (c) 2013-2018 Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.
// Image popup with CSS-styles plugin
class YellowImgPop
{
	const Version = "1.1.0";
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
		if($name=="imgpop" && $shortcut) {
			list($TheImage, $TheTitle, $TheID, $TheClass) = $this->yellow->toolbox->getTextArgs($text);
			if(empty($TheImage)) {
				$output = '<b style=\"color:#FF0000\">Image Source Missing!</b>';  
			}
			else {
				if (preg_match('/de/i', $_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
					$NoTitle = "Ohne Bildbeschreibung.";
				} 
				else {
					$NoTitle = "Without image description.";
				}
			if(empty($TheID)) $TheID = time();
			$TheClass = (empty($TheClass)) ? $TheClass = '' : $TheClass = ' class="' . $TheClass . '"';
			$TheImage = $this->yellow->config->get("imageDir").$TheImage;
		    if(empty($TheTitle)){
				$exif = @exif_read_data($TheImage, 'COMMENT',true,false);
				$TheTitle = utf8_encode($exif['COMMENT'][0]);
		    }
		    if(empty($TheTitle)) $TheTitle = $NoTitle;
			// $TheTitle = strip_tags($TheTitle,'<br>');
			$tip = strip_tags($TheTitle);
				$output = '<span id="' . $TheID . '"' . $TheClass . '>';
				$output .= '<a id="' . $TheID . 'close" href="#' . $TheID . '" title="' . $tip . '">';
				$output .= '<img' . $TheClass . ' src="/' . $TheImage . '" title="' . $tip . '"></a>';
				$output .= '<span class="imgnote">' . $TheTitle . '</span>';
				$output .= '<a class="closer" href="#' . $TheID . 'close">&otimes;</a>';
				$output .= '</span>'; 
			}
		}
		return $output;
	}
}
?>
