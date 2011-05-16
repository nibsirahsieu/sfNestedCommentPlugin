function setupAjaxCommentForm(nestedEnabled)
{
  document.getElementById('sfNestedComment_add_comment_form').onsubmit = function () {
    var form = jQuery('#sfNestedComment_add_comment_form');
    var loader = jQuery('#add-comment-loader');
    jQuery.ajax({
      type: "post",
      url: form.attr('action'),
      data: form.serialize(),
      beforeSend: function() { loader.show();  },
      success:function(response, textStatus) {
        jQuery('#sfNestedComments').html(response);
        if(nestedEnabled) {
        jQuery('#commentlist').collapsible({
          imagehide: '/sfNestedCommentPlugin/images/arrow-down.png',
          imageshow: '/sfNestedCommentPlugin/images/arrow-right.png',
          defaulthide: false
        });
        }
        loader.hide();
      },
      error:function(XMLHttpRequest, textStatus, errorThrown) {
        jQuery('#respond').html(XMLHttpRequest.responseText)
        loader.hide();
      }
    });
    return false;
  };

  jQuery(document).ready(function() {
    jQuery('textarea.resizable:not(.processed)').TextAreaResizer();
  });
}
