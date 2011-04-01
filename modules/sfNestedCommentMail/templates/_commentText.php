<?php use_helper('Date', 'I18N') ?>

<?php echo __('A new comment has been posted on the post "%1%".', array('%1%' => $comment->getCommentableObject()->__toString())) ?>


<?php echo __('Author: ').$comment->getAuthorName() ?>

<?php echo __('Email: ').mail_to($comment->getAuthorEmail(), $comment->getAuthorEmail()) ?>

<?php echo __('Website: ').$comment->getAuthorUrl() ?>

<?php echo __('Comment: ').$comment->getContent(ESC_RAW) ?>


<?php if($comment->getIsModerated()): ?>
  <?php echo __('This comment was automatically moderated and is waiting for your approval.') ?>

  <?php $url_approve = url_for('@sf_nested_comment_toggle_publish?id='.$comment->getId(), true) ?>
  Approve it: <a href="<?php echo $url_approve ?>"><?php echo $url_approve ?></a>
<?php endif; ?>
<?php if (false !== $url = url_for_commentable_object($comment->getCommentableObject(), true)): ?>
  <a href="<?php echo $url.'#comment-'.$comment->getId() ?>"><?php echo __('Go to comment') ?></a>
<?php endif; ?>