<?php
class sfNestedCommentPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    if ($this->configuration instanceof sfApplicationConfiguration)
    {
      if (in_array('sfNestedComment', sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfNestedCommentRouting', 'listenToRoutingLoadConfigurationEvent'));
        if (sfConfig::get('app_sfNestedComment_use_packaged_style', true))
        {
          $this->dispatcher->connect('context.load_factories', array('sfNestedCommentRouting', 'listenToContextLoadFactoriesEvent'));
        }
      }
      if (in_array('sfNestedCommentAdmin', sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfNestedCommentRouting', 'addRouteForNestedCommentAdmin'));
      }
      sfOutputEscaper::markClassAsSafe('sfNestedCommentsRenderer');
    }
  }
}
