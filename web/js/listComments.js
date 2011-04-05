function collapsibleComments(nestedEnabled)
{
  if(nestedEnabled){
  jQuery('#commentlist').collapsible({
    imagehide: '/sfNestedCommentPlugin/images/arrow-down.png',
    imageshow: '/sfNestedCommentPlugin/images/arrow-right.png',
    defaulthide: false
  });
  }
};

function setupAjaxListComments(model, model_id, nestedEnabled)
{
  jQuery(document).ready(function() {
    jQuery('a.comment-link').live('click', function(event) {
      var comment_list = jQuery('#sfNestedComment_comment_list');
      comment_list.html("<img src= '/sfNestedCommentPlugin/images/loading.gif' />  Loading comments...");
      jQuery.get(this.href, {
          commentable_id: model_id,
          commentable_model: model
        }, function(response){
        comment_list.html(response);
        comment_list.show();
        collapsibleComments(nestedEnabled);
      });
      return false;
    });
    collapsibleComments(nestedEnabled);
  });
}