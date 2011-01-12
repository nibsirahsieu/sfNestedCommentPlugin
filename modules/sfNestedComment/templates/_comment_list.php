<?php $use_ajax = sfConfig::get('app_sfNestedComment_use_ajax', true) ?>
<?php $enable_nested = sfConfig::get('app_sfNestedComment_nested', true) ?>

<?php if (sfConfig::get('app_sfNestedComment_paging', true)): ?>
  <?php use_helper('sfNestedCommentPagination') ?>
  <?php $url = $use_ajax ? '@sf_nested_comment_commenting' : $sf_request->getPathInfoPrefix().$sf_request->getPathInfo() ?>
  <?php echo comment_pagination($comments, $url, $sf_request->getParameterHolder(), 'Earlier Comments', 'Older Comments') ?>
  <?php $comments = $comments->getResults() ?>
<?php endif; ?>
<?php $renderer = sfNestedCommentTools::createCommentsRenderer($comments, $enable_nested) ?>
<?php echo $renderer->render() ?>