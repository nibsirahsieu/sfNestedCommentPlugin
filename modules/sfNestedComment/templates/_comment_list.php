<?php $use_ajax = sfNestedCommentConfig::isAjaxEnabled() ?>
<?php $enable_nested = sfNestedCommentConfig::isNestedEnabled() ?>

<?php if (sfNestedCommentConfig::isNestedEnabled()): ?>
  <?php use_helper('sfNestedCommentPagination') ?>
  <?php $url = $use_ajax ? '@sf_nested_comment_commenting' : $sf_request->getPathInfoPrefix().$sf_request->getPathInfo() ?>
  <?php echo comment_pagination($comments, $url, $sf_request->getParameterHolder(), 'Earlier Comments', 'Older Comments') ?>
  <?php $comments = $comments->getResults() ?>
<?php endif; ?>
<?php $renderer = sfNestedCommentTools::createCommentsRenderer($comments, $enable_nested) ?>
<?php echo $renderer->render() ?>