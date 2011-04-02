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
  <?php if ($object instanceof sfOutputEscaper): ?>
    <?php $model = get_class($object->getRawValue()) ?>
  <?php else: ?>
    <?php $model = get_class($object) ?>
  <?php endif; ?>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('a.comment-link').live('click', function(event) {
      var comment_list = jQuery('#sfNestedComment_comment_list');
      comment_list.html('<?php echo image_tag('/sfNestedCommentPlugin/images/loading.gif') ?>&nbsp;<?php echo __('Loading comments...') ?>');
      jQuery.get(this.href, {
          commentable_id: '<?php echo $object->getPrimaryKey() ?>',
          commentable_model: '<?php echo $model ?>'
        }, function(response){
        comment_list.html(response);
        comment_list.show();
      });
      return false;
    });
    <?php if($enable_nested): ?>
    jQuery('#commentlist').collapsible({
      imagehide: '<?php echo image_path('/sfNestedCommentPlugin/images/arrow-down.png') ?>',
      imageshow: '<?php echo image_path('/sfNestedCommentPlugin/images/arrow-right.png') ?>',
      defaulthide: false
    });
    <?php endif; ?>
  });
</script>
<?php endif; ?>