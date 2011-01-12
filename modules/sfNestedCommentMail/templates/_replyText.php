<?php use_helper('I18N') ?>
<?php $commentableObject = $reply->getCommentableObject() ?>
<?php echo $reply->getAuthorName() ?><?php echo __(' replied to your comment on ')?> <a href="<?php echo $sf_request->getHost().$commentableObject->getUrl() ?>" ><?php echo $commentableObject->getTitle() ?></a>

<?php echo $reply->getContent(ESC_RAW) ?>
<a href="<?php echo $sf_request->getHost().$commentableObject->getUrl().'#comment-'.$reply->getId() ?>" ><?php echo  __('Go to comment') ?></a>

<?php echo __('In reply to your comment:') ?>

<?php echo $comment->getContent(ESC_RAW) ?>