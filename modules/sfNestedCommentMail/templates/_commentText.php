<?php use_helper('Date', 'I18N') ?>

<?php echo __('A new comment has been posted on the post "%1%".', array('%1%' => $comment->getCommentableObject()->getTitle())) ?>


<?php echo __('Author: ').$comment->getAuthorName() ?>

<?php echo __('Email: ').mail_to($comment->getAuthorEmail(), $comment->getAuthorEmail()) ?>

<?php echo __('Website: ').$comment->getAuthorUrl() ?>

<?php echo __('Comment: ').$comment->getContent() ?>


<?php if($comment->getIsModerated()): ?>
  <?php echo __('This comment was automatically moderated and is waiting for your approval.') ?>
<?php endif; ?>
<a href="<?php echo $sf_request->getHost().$comment->getCommentableObject()->getUrl().'#comment-'.$comment->getId() ?>"><?php echo __('Go to comment') ?></a>