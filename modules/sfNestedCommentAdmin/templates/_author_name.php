<strong><?php echo $sf_nested_comment->getAuthorName() ?></strong><br/>
<?php if ($email = $sf_nested_comment->getAuthorEmail()): ?>
  <?php echo mail_to($email, $email) ?>
<?php endif; ?>