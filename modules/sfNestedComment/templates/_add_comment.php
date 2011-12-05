<?php use_helper('I18N') ?>
<?php $use_ajax = sfNestedCommentConfig::isAjaxEnabled() ?>
<?php if ($use_ajax): ?>
  <?php use_stylesheet('/sfNestedCommentPlugin/css/commentPreview.css', 'last') ?>
  <?php use_stylesheet('/sfNestedCommentPlugin/css/jquery.textarearesizer.css', 'last') ?>
  <?php use_javascript('/sfNestedCommentPlugin/js/commentPreview.js', 'last') ?>
  <?php use_javascript('/sfNestedCommentPlugin/js/jquery.textarearesizer.compressed.js', 'last') ?>
<?php endif; ?>

<div id="respond">
  <h3 id="replay-title"><?php echo __('Leave a reply') ?>&nbsp;<small><a href="#respond" id="cancel-comment-reply-link">Cancel Reply</a></small></h3>
  <form action="<?php echo url_for('@sf_nested_commend_add') ?>" name='add_comment' class='add_comment' id='sfNestedComment_add_comment_form' method="post">
    <?php echo $commentForm ?>
    <div class="form-submit">
      <input type="submit" value="<?php echo (__('Submit comment')) ?>" id="sumbit-comment" />
      <?php if($use_ajax): ?>
        <input type="button" value="Preview" id="preview-comment-button" />
        <span id="add-comment-loader" style="display:none;"><?php echo image_tag('/sfNestedCommentPlugin/images/loading.gif') ?></span>
      <?php endif; ?>
    </div>
  </form>
  <?php if($use_ajax): ?>
    <div class="lp-block" id="live-preview-display">
      <div id="lp-comment"></div>
    </div>
  <?php endif; ?>
</div>
<?php if($use_ajax): ?>
  <?php use_javascript('/sfNestedCommentPlugin/js/commentForm.js') ?>
  <script type="text/javascript">
    setupAjaxCommentForm(<?php echo sfNestedCommentConfig::isNestedEnabled() ?>);
  </script>
<?php endif; ?>
