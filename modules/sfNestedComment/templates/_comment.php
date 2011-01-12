<?php use_helper('Date') ?>
<div id="comment-<?php echo $comment->getId() ?>">
  <div class="comment-author">
    <?php if (sfConfig::get('app_sfNestedComment_use_gravatar', true)): ?>
      <?php use_helper('Gravatar') ?>
      <?php echo gravatar_image_tag($comment->getAuthorEmail(), null, 40) ?>
    <?php endif; ?>
    <cite class="fn"><?php echo $comment->getAuthorUrl() ? link_to($comment->getAuthorName(), $comment->getAuthorUrl()) : $comment->getAuthorName() ?></cite>
    <span class="says"><?php echo __('says') ?>:</span>
  </div>
  <div class="comment-meta">
    <?php echo format_date(strtotime($comment->getCreatedAt()), 'D') ?> at <?php echo format_datetime(strtotime($comment->getCreatedAt()), 't') ?>
  </div>
  <div class="comment-body">
    <?php echo $comment->getContent() ?>
  </div>
  <div class="reply"><a href="#respond" onclick="return addComment.moveForm('comment-<?php echo $comment->getId() ?>', '<?php echo $comment->getId() ?>', 'respond', '<?php echo $comment->getCommentableId() ?>')">Reply</a></div>
</div>
