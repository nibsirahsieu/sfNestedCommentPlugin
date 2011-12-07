<?php use_helper('sfNestedComment', 'I18N') ?>
<?php $use_gravatar = sfNestedCommentConfig::isGravatarEnabled() ?>
<?php if ($use_gravatar): ?>
  <?php use_helper('Gravatar') ?>
<?php endif; ?>
<?php $cls = 'recentcommentsavatar' ?>
<table class="<?php echo $cls ?>" cellspacing="0" cellpadding="0" border="0">
  <tbody>
    <?php $i = 1 ?>
    <?php foreach($comments as $comment): ?>
      <?php $commentableObject = $comment->getCommentableObject() ?>
      <?php $suffix = $i == 1 ? 'top' : 'end' ?>
      <tr>
        <?php if ($use_gravatar): ?>
        <td class="<?php echo $cls.$suffix ?>" style="height: 32px; width: 32px" title="<?php echo $comment->getAuthorName() ?>">
          <?php if ($comment->getAuthorUrl()): ?>
          <a rel="nofollow" href="<?php echo $comment->getAuthorUrl() ?>">
            <?php echo gravatar_image_tag($comment->getAuthorEmail(), null, 32) ?>
          </a>
          <?php else: ?>
            <?php echo gravatar_image_tag($comment->getAuthorEmail(), null, 32) ?>
          <?php endif; ?>
        </td>
        <?php endif; ?>
        <td class="recentcommentstext<?php echo $suffix?>">
          <?php if ($comment->getAuthorUrl()): ?>
            <a rel="nofollow" href="<?php echo $comment->getAuthorUrl() ?>"><?php echo $comment->getAuthorName() ?></a>
          <?php else: ?>
            <?php echo $comment->getAuthorName() ?>
          <?php endif; ?>
          <?php echo __('on') ?>&nbsp;
          <?php if (false !== $url = url_for_commentable_object($commentableObject)): ?>
            <a href="<?php echo $url.'#comment-'.$comment->getId() ?>"><?php echo sfNestedCommentTools::ellipsis($commentableObject->__toString()) ?></a>
          <?php else: ?>
            <?php echo sfNestedCommentTools::ellipsis($commentableObject->__toString()) ?>
          <?php endif; ?>
        </td>
      </tr>
      <?php $i++ ?>
    <?php endforeach; ?>
  </tbody>
</table>