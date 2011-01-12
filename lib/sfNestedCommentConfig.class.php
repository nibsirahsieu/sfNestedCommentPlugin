<?php
class sfNestedCommentConfig
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_nested_comment_commenting', new sfRoute('/comment/show', array('module' => 'sfNestedComment', 'action' => 'commenting')));
    $r->prependRoute('sf_nested_commend_add', new sfRoute('/comment/add', array('module' => 'sfNestedComment', 'action' => 'addComment')));
  }

  public static function listenToContextLoadFactoriesEvent(sfEvent $event)
  {
    /** @var sfContext */
    $context = $event->getSubject();
    $context->getResponse()->addStylesheet('/sfNestedCommentPlugin/css/sfNestedComment.css');
  }

  static public function addRouteForNestedCommentAdmin(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_nested_comment', new sfPropel15RouteCollection(array(
      'name'                 => 'sf_nested_comment',
      'model'                => 'sfNestedComment',
      'module'               => 'sfNestedCommentAdmin',
      'prefix_path'          => 'sf_nested_comment',
      'with_wildcard_routes' => true,
      'requirements'         => array(),
    )));
  }
}