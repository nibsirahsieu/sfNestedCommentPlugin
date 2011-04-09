jQuery(document).ready(function() {
  jQuery('#preview-comment-button').click(function(){
    var commentBox = jQuery('#lp-comment');
    var loader = jQuery('#add-comment-loader');
    jQuery.ajax({
      type: 'POST',
      url: location.protocol + '//' + location.host + '/sfNestedComment/preview',
      async: false,
      data: { commentText: jQuery('#sf_nested_comment_content').val() },
      beforeSend:function() { loader.show(); },
      success:function(response, textStatus) {
        commentBox.html(response);
        loader.hide();
      },
      error:function(XMLHttpRequest, textStatus, errorThrown) {
        loader.hide();
        alert(textStatus);
      }
    });
  });
});