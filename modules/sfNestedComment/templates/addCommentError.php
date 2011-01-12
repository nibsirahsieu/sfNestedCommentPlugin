<?php use_helper('I18N') ?>
<p class="error-page">
  <?php echo __('Please fill the required fields') ?>
</p>
<p>
  <span class="meta-nav">&larr;</span><a href="<?php echo $sf_request->getReferer() ?>"><?php echo __('Back to post') ?></a>
</p>