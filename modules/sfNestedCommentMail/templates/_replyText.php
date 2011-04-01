<?php use_helper('I18N', 'sfNestedComment') ?>

<?php $commentableObject = $reply->getCommentableObject() ?>
<?php $url_callable = url_for_commentable_object($commentableObject, true) ?>

<?php if (false !== $url_callable): ?>
  <?php echo $reply->getAuthorName() ?><?php echo __(' replied to your comment on ')?> <a href="<?php echo $url_callable ?>" ><?php echo $commentableObject->__toString() ?></a>
<?php else: ?>
  <?php echo $reply->getAuthorName() ?><?php echo __(' replied to your comment on ')?> <?php echo $commentableObject->__toString() ?>
<?php endif; ?>
<?php echo $reply->getContent(ESC_RAW) ?>
<?php if (false !== $url_callable): ?>
  <a href="<?php echo $url_callable.'#comment-'.$reply->getId() ?>"><?php echo __('Go to comment') ?></a>
<?php endif; ?>

<?php echo __('In reply to your comment:') ?>

<?php echo $comment->getContent(ESC_RAW) ?>