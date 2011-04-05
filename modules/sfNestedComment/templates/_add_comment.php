<?php $use_ajax = sfNestedCommentConfig::isAjaxEnabled() ?>

<div id="respond">
  <h3 id="replay-title"><?php echo __('Leave a reply') ?>&nbsp;<small><a href="#respond" id="cancel-comment-reply-link">Cancel Reply</a></small></h3>
  <form action="<?php echo url_for('@sf_nested_commend_add') ?>" name='add_comment' class='add_comment' id='sfNestedComment_add_comment_form' method="post">
    <?php echo $commentForm ?>
    <div class="form-submit">
      <input type="submit" value="<?php echo (__('Submit comment')) ?>" id="sumbit-comment" />
      <?php if($use_ajax): ?>
        <span id="add-comment-loader" style="display:none;"><?php echo image_tag('/sfNestedCommentPlugin/images/loading.gif') ?></span>
      <?php endif; ?>
    </div>
    <input type="hidden" name="referer" value="<?php echo $sf_request->getReferer() ?>" />
  </form>
</div>

<?php if($use_ajax): ?>
  <?php use_javascript('/sfNestedCommentPlugin/js/commentForm.js') ?>
  <script type="text/javascript">
    setupAjaxCommentForm(<?php echo sfNestedCommentConfig::isNestedEnabled() ?>);
  </script>
<?php endif; ?>