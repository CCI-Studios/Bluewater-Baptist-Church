<?php
/**
 * @version		$Id: default.php 502 2010-06-24 20:33:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ItemsBlock <?php echo $params->get('moduleclass_sfx'); ?>">

	<?php if($params->get('itemPreText')): ?>
	<p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
	<?php endif; ?>

	<?php if(count($items)): ?>
	<div class="masthead_box">
    <?php foreach ($items as $key=>$item):	?>
    	<div class="description <?php if ($key == 0) { echo 'first'; } ?> <?php if ($key == count($items)-1) { echo 'last'; } ?>">
    		<div class="intro">
	    		<h2><?php echo $item->title?></h2>
    			<p>
    				<?php if (count($item->extra_fields)):
    					$posStart = stripos($item->extra_fields[0]->value, "href=\"");
    					$posEnd = stripos($item->extra_fields[0]->value, "\">");
    					$url = substr($item->extra_fields[0]->value, $posStart+6, $posEnd - $posStart - 4);
    					    					
						if ($url !== 'http://'): ?>
		    				<a href="<?php echo $url; ?>"><?php echo $item->introtext; ?></a>
		    			<?php else: ?>
		    				<?php echo $item->introtext; ?>
		    			<?php endif; 
    				else: ?>
    					<?php echo $item->introtext; ?>
    				<?php endif; ?>
    			</p>
    		</div>
    		
    		<div class="image">
    			<img src="<?php echo $item->image; ?>" width="958" height="383" alt="<?php echo $item->title;?>" />
    		</div>
    	</div>    	
    <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>