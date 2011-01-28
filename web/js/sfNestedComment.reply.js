//taken from wordpress with few modifications
addComment = {
  moveForm: function(commId, parentId, respondId, postId, prefix) {
    if (prefix == undefined) prefix = 'sf_nested_comment';
    var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I(prefix+'_sf_comment_id'), post = t.I(prefix+'_commentable_id');

    if (!comm || !respond || !cancel || !parent ) return;

    t.respondId = respondId;
    postId = postId || false;

    if (!t.I('wp-temp-form-div')) {
      div = document.createElement('div');
      div.id = 'wp-temp-form-div';
      div.style.display = 'none';
      respond.parentNode.insertBefore(div, respond);
    }

    comm.parentNode.insertBefore(respond, comm.nextSibling);
    if ( post && postId ) post.value = postId;
    parent.value = parentId;
    cancel.style.display = 'block';

    cancel.onclick = function() {
      var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

      if (!temp || !respond) return;

      t.I(prefix+'_sf_comment_id').value = "";
      temp.parentNode.insertBefore(respond, temp);
      temp.parentNode.removeChild(temp);
      this.style.display = 'none';
      this.onclick = null;
      return false;
    }

    try { t.I(prefix+'_content').focus(); }
    catch(e) {}

    return false;
  },

  I : function(e) {
    return document.getElementById(e);
  }
}

