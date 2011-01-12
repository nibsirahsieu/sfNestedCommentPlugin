<fieldset id="sf_fieldset_none">
  <div class="sf_admin_form_row sf_admin_plain">
    <div>
      <label for="sf_nested_comment_author_name">Author</label>
      <div class="content"><div><?php echo $comment->getAuthorName() ?></div></div>
    </div>
  </div>
  <div class="sf_admin_form_row sf_admin_plain">
    <div>
      <label for="sf_nested_comment_author_name">Email</label>
      <div class="content"><div><?php echo $comment->getAuthorEmail() ?></div></div>
    </div>
  </div>
  <div class="sf_admin_form_row sf_admin_plain">
    <div>
      <label for="sf_nested_comment_author_name">Website</label>
      <div class="content"><div><?php echo $comment->getAuthorUrl() ?></div></div>
    </div>
  </div>
  <div class="sf_admin_form_row sf_admin_plain">
    <div>
      <label for="sf_nested_comment_author_name">Comment</label>
      <div class="content"><div><?php echo $comment->getContent() ?></div></div>
    </div>
  </div>
</fieldset>