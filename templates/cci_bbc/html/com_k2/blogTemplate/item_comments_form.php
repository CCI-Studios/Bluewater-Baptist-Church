<?php
/**
 * @version		$Id: item_comments_form.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<h3><?php echo JText::_('Leave a comment') ?></h3>

<?php if($this->params->get('commentsFormNotes')): ?>
<p class="itemCommentsFormNotes"><?php echo nl2br($this->params->get('commentsFormNotesText')); ?></p>
<?php endif; ?>

<form action="<?php echo JURI::root(); ?>index2.php" method="post" id="comment-form" class="form-validate">
	<div class="left">
	<label class="formName" for="userName">*<?php echo JText::_( 'Name' ); ?></label><br/>
	<input class="inputbox" type="text" name="userName" id="userName" /><br/><br/>
	</div>

	<div class="left" style="margin-left: 10px;">
	<label class="formEmail" for="commentEmail">*<?php echo JText::_( 'E-mail' ); ?></label><br/>
	<input class="inputbox" type="text" name="commentEmail" id="commentEmail" /><br/><br/>
	</div>
	
	<div class="clr"></div>
		
	<label class="formComment" for="commentText">*<?php echo JText::_( 'Message' ); ?></label><br/>
	<textarea rows="5" cols="40" class="inputbox" name="commentText" id="commentText"></textarea><br/><br/>

	<input type="hidden" name="commentURL" id="commentURL"  />

	<?php if($this->params->get('recaptcha') && $this->user->guest): ?>
	<label class="formRecaptcha"><?php echo JText::_('Enter the two words you see below'); ?></label><br/>
	<div id="recaptcha"></div><br/>
	<?php endif; ?>

	<input type="submit" class="button" id="submitCommentButton" value="<?php echo JText::_( 'Submit comment' ); ?>" />

	<span id="formLog"></span>

	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="item" />
	<input type="hidden" name="task" value="comment" />
	<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
</form>
