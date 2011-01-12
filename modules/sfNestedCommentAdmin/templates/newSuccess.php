<?php use_javascript('/js/tiny_mce/tiny_mce.js') ?>
<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfNestedCommentAdmin/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Comment', array(), 'messages') ?></h1>

  <?php include_partial('sfNestedCommentAdmin/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('sfNestedCommentAdmin/form_header', array('sf_nested_comment' => $sf_nested_comment, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('sfNestedCommentAdmin/comment_to_reply', array('comment' => $parent_comment)) ?>

  <br/>
  <h1><?php echo __('Reply', array(), 'messages') ?></h1>
  <div id="sf_admin_content">
    <?php include_partial('sfNestedCommentAdmin/form', array('sf_nested_comment' => $sf_nested_comment, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfNestedCommentAdmin/form_footer', array('sf_nested_comment' => $sf_nested_comment, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
