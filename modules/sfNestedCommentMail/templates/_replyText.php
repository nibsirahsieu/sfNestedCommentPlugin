<?php use_helper('I18N', 'crossAppLink') ?>
<?php $commentableObject = $reply->getCommentableObject() ?>
<?php $callable = sfConfig::get('app_sfNestedComment_url_commentable_method') ?>

<!-- note: if you are using different app for frontend application, you can use omCrossAppUrlPlugin to enable cross linking application-->
<!-- example : $url_approve = cross_app_url_for('frontend', call_user_func($callable, $commentableObject), true) -->
<?php $url_callable = $callable ?  url_for(call_user_func($callable, $commentableObject), true) : '' ?>
<?php if ($url_callable): ?>
  <?php echo $reply->getAuthorName() ?><?php echo __(' replied to your comment on ')?> <a href="<?php echo $url_callable ?>" ><?php echo $commentableObject->__toString() ?></a>
<?php else: ?>
  <?php echo $reply->getAuthorName() ?><?php echo __(' replied to your comment on ')?> <?php echo $commentableObject->__toString() ?>
<?php endif; ?>
<?php echo $reply->getContent(ESC_RAW) ?>
<?php if ($url_callable): ?>
  <a href="<?php echo $url_callable.'#comment-'.$reply->getId() ?>"><?php echo __('Go to comment') ?></a>
<?php endif; ?>

<?php echo __('In reply to your comment:') ?>

<?php echo $comment->getContent(ESC_RAW) ?>