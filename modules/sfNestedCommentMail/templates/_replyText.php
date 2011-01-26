<?php use_helper('I18N') ?>
<?php $commentableObject = $reply->getCommentableObject() ?>
<?php echo $reply->getAuthorName() ?><?php echo __(' replied to your comment on ')?> <a href="<?php echo $sf_request->getHost().$commentableObject->getUrl() ?>" ><?php echo $commentableObject->getTitle() ?></a>

<?php echo $reply->getContent(ESC_RAW) ?>
<?php if ($callable = sfConfig::get('app_sfNestedComment_url_method')): ?>
  <a href="<?php echo url_for(call_user_func($callable, $commentableObject), true).'#comment-'.$reply->getId() ?>"><?php echo __('Go to comment') ?></a>
<?php endif; ?>

<?php echo __('In reply to your comment:') ?>

<?php echo $comment->getContent(ESC_RAW) ?>