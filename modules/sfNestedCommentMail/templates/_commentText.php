<?php use_helper('Date', 'I18N') ?>

<?php echo __('A new comment has been posted on the post "%1%".', array('%1%' => $comment->getCommentableObject()->__toString())) ?>


<?php echo __('Author: ').$comment->getAuthorName() ?>

<?php echo __('Email: ').mail_to($comment->getAuthorEmail(), $comment->getAuthorEmail()) ?>

<?php echo __('Website: ').$comment->getAuthorUrl() ?>

<?php echo __('Comment: ').$comment->getContent(ESC_RAW) ?>


<?php if($comment->getIsModerated()): ?>
  <?php echo __('This comment was automatically moderated and is waiting for your approval.') ?>

  <!-- note: if you are using different app for backend application, you can use omCrossAppUrlPlugin to enable cross linking application-->
  <!-- example : $url_approve = cross_app_url_for('backend', '@sf_nested_comment_toggle_publish?id='.$comment->getId(), true) -->
  <?php $url_approve = url_for('@sf_nested_comment_toggle_publish?id='.$comment->getId(), true) ?>
  Approve it: <a href="<?php echo $url_approve ?>"><?php echo $url_approve ?></a>
<?php endif; ?>
<?php if ($callable = sfConfig::get('app_sfNestedComment_url_commentable_method')): ?>
  <a href="<?php echo url_for(call_user_func($callable, $comment->getCommentableObject()), true).'#comment-'.$comment->getId() ?>"><?php echo __('Go to comment') ?></a>
<?php endif; ?>
