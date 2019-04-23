<?php
// imgPop extension, https://github.com/BsNoSi/yellow-extension-imgpop
// imgpop Copyright (c) 2018-now Norbert Simon, http://www.nosi.de for
// YELLOW-CMS Copyright (c)2013-now Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.

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
	public function onParseContentShortcut($page, $name, $text, $type) {
		$output = NULL;
		if($name=="imgpop") {
			list($TheImage, $TheTitle, $TheID, $TheClass) = $this->yellow->toolbox->getTextArgs($text);
			
					
			if(empty($TheImage)) {
				$output = '<b style=\"color:#FF0000\">' . $this->yellow->text->get("imgpop_NoImg") . '</b>';  
			}
		else {	
			$TheID = $TheID ? : time();
			$TheClass = (!$TheClass) ? $TheClass = '' : $TheClass = ' class="' . $TheClass . '"';
			
			$TheImage = $this->yellow->system->get("imageDir").$TheImage;
			
			if(empty($TheTitle)){
				$exif = @exif_read_data($TheImage, 'COMMENT',true,false);
				$TheTitle = utf8_encode($exif['COMMENT'][0]);
		    }
		    if(empty($TheTitle)) $TheTitle = $this->yellow->text->get("imgpop_NoTitle");
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
		
		// Handle page extra data
		public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $extensionLocation = $this->yellow->system->get("serverBase").$this->yellow->system->get("extensionLocation");
            $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}imgpop.css\" />\n";
        }
        return $output;
	}
}
?>
