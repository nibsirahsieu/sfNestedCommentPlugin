<?php $use_ajax = sfConfig::get('app_sfNestedComment_use_ajax', true) ?>

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
<script type="text/javascript">
  document.getElementById('sfNestedComment_add_comment_form').onsubmit = function () {
    var form = jQuery('#sfNestedComment_add_comment_form');
    loader = jQuery('#add-comment-loader');
    jQuery.ajax({
      type: "post",
      url: form.attr('action'),
      data: form.serialize(),
      beforeSend: function() { loader.show();  },
      success:function(response, textStatus) {
        jQuery('#sfNestedComments').html(response);
        <?php if(sfConfig::get('app_sfNestedComment_nested', true)): ?>
        jQuery('#commentlist').collapsible({
          imagehide: '<?php echo image_path('/sfNestedCommentPlugin/images/arrow-down.png') ?>',
          imageshow: '<?php echo image_path('/sfNestedCommentPlugin/images/arrow-right.png') ?>',
          defaulthide: false
        });
        <?php endif; ?>
        loader.hide();
      },
      error:function(XMLHttpRequest, textStatus, errorThrown) {
        jQuery('#respond').html(XMLHttpRequest.responseText)
        loader.hide();
      }
    });
    return false; 
  };  
</script>
<?php endif; ?>