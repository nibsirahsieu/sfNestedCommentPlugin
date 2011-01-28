<?php use_helper('Date', 'I18N') ?>

<?php echo __('A new comment has been posted on the post "%1%".', array('%1%' => $comment->getCommentableObject()->__toString())) ?>
<br/><br/>

<?php echo __('Author: ').$comment->getAuthorName() ?>
<br/>
<?php echo __('Email: ').mail_to($comment->getAuthorEmail(), $comment->getAuthorEmail()) ?>
<br/>
<?php echo __('Website: ').$comment->getAuthorUrl() ?>
<br/>
<?php echo __('Comment: ') ?>
<br/>
<?php echo $comment->getContent() ?>
<br/><br/>

<?php if($comment->getIsModerated()): ?>
  <?php echo __('This comment was automatically moderated and is waiting for your approval.') ?>
<?php endif; ?>
<?php if ($callable = sfConfig::get('app_sfNestedComment_url_method')): ?>
  <a href="<?php echo url_for(call_user_func($callable, $comment->getCommentableObject()), true).'#comment-'.$comment->getId() ?>"><?php echo __('Go to comment') ?></a>
<?php endif; ?>
