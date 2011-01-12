<?php $enable_comment = sfConfig::get('app_sfNestedComment_enabled', true) ?>
<?php if(0 < $nb_comments = $object->getNbApprovedComments()): ?>
  <h3 id="comments-title"><?php echo format_number_choice('[1]One comment so far|(1,+Inf]%1% comments so far', array('%1%' => $nb_comments), $nb_comments) ?></h3>
<?php endif; ?>
<div id="sfNestedComment_comment_list">
  <?php include_partial('sfNestedComment/comment_list', array('comments' => $comments)) ?>
</div>
<?php if(!$enable_comment): ?>
  <div class="related_details"><?php echo __('Comments are closed.') ?></div>
<?php elseif($sf_user->getFlash('add_comment') == 'moderated'): ?>
  <div class="comment moderated"><?php echo __('Your comment has been submitted and is awaiting moderation') ?></div>
<?php endif; ?>
<?php if($enable_comment): ?>
  <?php include_partial('sfNestedComment/add_comment', array('commentForm' => $commentForm)) ?>
<?php endif; ?>