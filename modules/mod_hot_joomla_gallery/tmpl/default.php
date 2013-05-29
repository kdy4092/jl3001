<?php
/*------------------------------------------------------------------------
# "Hot Joomla Gallery" Joomla module
# Copyright (C) 2010 ArhiNet d.o.o. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access'); // no direct access

// get the document object
$doc =& JFactory::getDocument();

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_joomla_gallery/tmpl/style.css' );

// style declaration
$doc->addStyleDeclaration( '

.slideViewer span.typo { 
background:'.$descTextBackground.';
color:'.$descTextColor.';
}

#hot-joomla-gallery-wrapper { 
background:'.$galleryBackground.';
border:'.$galleryBorder.'px solid '.$galleryBorderColor.';
}

' );

?>

<?php if ($enablejQuery!=0) { ?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_gallery/js/jquery.min.js"></script>
<?php } ?>

<script src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_gallery/js/slideViewerPro.js" type="text/javascript"></script> 

<script type="text/javascript">
jQuery(window).bind("load", function() { 
    jQuery("div#hot-joomla-gallery").slideViewerPro({ 
        thumbs: <?php echo $thumbsNumber; ?>,  
        autoslide: true,  
        asTimer: <?php echo $timerValue; ?>,  
        typo: <?php if ($userInput) { echo "true"; }else{ echo "false"; } ?>, 
        galBorderWidth: <?php echo $bigImageBorder; ?>, 
		galBorderColor: "<?php echo $bigImageBorderColor; ?>",
		thumbsBorderColor: "<?php echo $thumbBorderColor; ?>",
        thumbsActiveBorderColor: "<?php echo $activeThumbBorderColor; ?>",
		thumbsPercentReduction: <?php echo $thumbsSize; ?>,
        shuffle: false,
		leftButtonInner: "<img src='<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_gallery/images/circleleft32.png' width='32' height='32' alt='' />", 
		rightButtonInner: "<img src='<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_gallery/images/circleright32.png' width='32' height='32' alt='' />"
    }); 
}); 
</script>

<script type="text/javascript">
jQuery(function(){
   jQuery("div.svwp").prepend("<img src='<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_gallery/images/svwloader.gif' class='ldrgif' alt='loading...' />"); //change with YOUR loader image path   
});
</script>

<script src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_gallery/js/jquery.timers-1.2.js" type="text/javascript"></script> 

<div id="hot-joomla-gallery-wrapper"> 
<div id="hot-joomla-gallery" class="svwp"> 
<ul>

<?php

if ($userInput) {		// if user need photos with description text

	$pics_with_descs = explode(";", $userInput);			// exploding of user's input into array of elements
	
	$pics_number = count($pics_with_descs) - 1;				// how many elements (pics+desc) we have (minus 1)
	
	for ($loop = 0; $loop <= $pics_number; $loop += 1) {	// loop where we explode each pic+desc into picture and desc 
	$pics[$loop] = explode("||", $pics_with_descs[$loop]);	// since we are exploding array elements, we have 2 dimensional array as result
	}
	
	for ($loop = 0; $loop <= $pics_number; $loop += 1) {
		echo '<li><img alt="'.$pics[$loop][1].'" src="'.$mosConfig_live_site.'/'.$imageFolder.'/'.$pics[$loop][0].'" width="'.$bigImageWidth.'" height="'.$bigImageHeight.'" /></li>';
		echo "\n";	// 1st element of 2dim array is pic, 2nd element is desc
	}

}else{
	
	$gallery_list = "";
	$galleryPath = $_SERVER['SCRIPT_FILENAME'];
	$galleryRealPath = substr_replace($galleryPath ,"",-9);
	$galleryFullPath = $galleryRealPath.$imageFolder;
	
	if ($handle = opendir($galleryFullPath)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (strpos($file, 'jpg') !== false || strpos($file, 'png') !== false || strpos($file, 'gif') !== false) {
					$gallery_list = $gallery_list."$file"."||";
				}
			}
		}
		closedir($handle);
		$gallery_pic = explode("||", $gallery_list);
		$gallery_pics_number = count($gallery_pic) - 2;
		for ($loop = 0; $loop <= $gallery_pics_number; $loop += 1) {
			echo '<li><img src="'.$mosConfig_live_site.'/'.$imageFolder.'/'.$gallery_pic[$loop].'" alt="" width="'.$bigImageWidth.'" height="'.$bigImageHeight.'" /></li>';
		}
	}
}

?>


</ul>
</div>
</div>