<?php $comment = $sf_nested_comment ?>
<?php $commentableObject = $comment->getCommentableObject() ?>
<?php use_helper('Date') ?>
<div class="submitted-on">
  <?php echo format_datetime(strtotime($comment->getCreatedAt()), 'f') ?>
</div>
<?php echo $comment->getContent(ESC_RAW) ?>
