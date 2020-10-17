<?php
// imgPop extension for YELLOW-CMS, https://github.com/BsNoSi/yellow-extension-imgpop
// imgpop Copyright (c)2018-now Norbert Simon, http://www.nosi.de for
// YELLOW-CMS Copyright (c)2013-now Datenstrom, https://datenstrom.se
// This file may be used and distributed under the terms of the public license.
//requires YELLOW 0.8.15 or higher

class YellowImgPop
{
 const Version = "1.7.6";
 public $yellow;

 public function onLoad($yellow) {
   $this->yellow = $yellow;
 }
    
 public function onParseContentShortcut($page, $name, $text, $type) {
   $output = NULL;
   if($name=="imgpop") {
	list($TheImage, $TheTitle, $TheID, $TheClass) = $this->yellow->toolbox->getTextArguments($text);
			
	if(empty($text)) {
		$output = '<b>{coreImageDir}TheImage TheTitle TheID TheClass Lng]</b>';  
	}
	else {
		$TheID = $TheID ? : pathinfo($TheImage)["filename"];
		$TheClass = (!$TheClass) ? $TheClass = ' class = "ipop"' : $TheClass = ' class="' . $TheClass . '"';
		
		$TheImage = $this->yellow->system->get("coreImageDirectory").$TheImage;
				
		if(empty($TheTitle)) {
			$check = $this->yellow->system->get("coreImageDirectory").pathinfo($TheImage)["filename"] . ".txt";
			if (file_exists($check)) {
				$TheTitle = file_get_contents($check);
			}
			else {
				$exif = @exif_read_data($TheImage, 'COMMENT',true,false);
				$TheTitle = utf8_encode($exif['COMMENT'][0]);
			}
		}
		if(empty($TheTitle)) $TheTitle = $this->yellow->language->getText("imgpop_NoTitle");
		$tip = strip_tags($TheTitle,"<br>,<br/>");
		$output = '<div' . $TheClass . '>';
		$output .= '<a class="iboxx" href="#' . $TheID . '"><img src="/' . $TheImage . '" title="'.$this->yellow->language->getText("imgpop_zoom").'" /><span class="imag">🔍</span></a>';
		$output .= '<a class="imgbox" id="' . $TheID . '"href="#_"><img src="/' . $TheImage . '"><span class="imgboxtitle">'.$tip.'</span></a></div>';
	}
   }
		return $output;
 }
		
// Handle page extra data
 public function onParsePageExtra($page, $name) {
  $output = null;
  if ($name=="footer") {
	  $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
	$output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}imgpop.css\" />\n";
  }
  return $output;
 }
}
?>
