<?php
class sfNestedCommentRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_nested_comment_commenting', new sfRoute('/comment/show', array('module' => 'sfNestedComment', 'action' => 'commenting')));
    $r->prependRoute('sf_nested_commend_add', new sfRoute('/comment/add', array('module' => 'sfNestedComment', 'action' => 'addComment')));
  }

  static public function addRouteForNestedCommentAdmin(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_nested_comment', new sfPropelORMRouteCollection(array(
      'name'                 => 'sf_nested_comment',
      'model'                => 'sfNestedComment',
      'module'               => 'sfNestedCommentAdmin',
      'prefix_path'          => 'sf_nested_comment',
      'with_wildcard_routes' => true,
      'requirements'         => array(),
    )));
    $event->getSubject()->prependRoute('sf_nested_comment_toggle_publish', new sfPropelORMRoute('/sf_nested_comment/:id/toggleApprove.:sf_format', array('module' => 'sfNestedCommentAdmin', 'action' => 'togglePublish', 'sf_format' => 'html'), array(), array('model' => 'sfNestedComment', 'type' => 'object')));
  }
}
