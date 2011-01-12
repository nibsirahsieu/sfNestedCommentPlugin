<?php use_helper('Date', 'I18N') ?>

<?php echo __('A new comment has been posted on the post "%1%".', array('%1%' => $comment->getCommentableObject()->getTitle())) ?>
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
<a href="<?php echo $sf_request->getHost().$comment->getCommentableObject()->getUrl().'#comment-'.$comment->getId() ?>"><?php echo __('Go to comment') ?></a>