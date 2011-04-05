<?php use_helper('I18N') ?>
<?php use_javascript('/sfNestedCommentPlugin/js/sfNestedComment.reply.js') ?>

<?php $use_ajax = sfNestedCommentConfig::isAjaxEnabled() ?>
<?php $enable_nested = sfNestedCommentConfig::isNestedEnabled() ?>
<?php if($use_ajax): ?>
  <?php use_javascript(sfConfig::get('sf_jquery_web_dir') . '/js/'.sfConfig::get('sf_jquery_core'), 'first') ?>
  <?php if($enable_nested): ?>
    <?php use_javascript('/sfNestedCommentPlugin/js/jCollapsible.js') ?>
  <?php endif; ?>
<?php endif; ?>

<div id="comments">
  <div id="sfNestedComments">
    <?php include_partial('sfNestedComment/comments', array('object' => $object, 'comments' => $comments, 'commentForm' => $commentForm)) ?>
  </div>
</div>

<?php if($use_ajax): ?>
  <?php use_javascript('/sfNestedCommentPlugin/js/listComments.js') ?>
  <?php if ($object instanceof sfOutputEscaper): ?>
    <?php $model = get_class($object->getRawValue()) ?>
  <?php else: ?>
    <?php $model = get_class($object) ?>
  <?php endif; ?>
<script type="text/javascript">
  setupAjaxListComments('<?php echo $model ?>', '<?php echo $object->getPrimaryKey() ?>', <?php echo sfNestedCommentConfig::isNestedEnabled() ?>);
</script>
<?php endif; ?>