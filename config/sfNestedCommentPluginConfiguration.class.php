<?php
class sfNestedCommentPluginConfiguration extends sfPluginConfiguration
{
  static protected $HTMLPurifierLoaded = false;
  
  public function initialize()
  {
    if ($this->configuration instanceof sfApplicationConfiguration)
    {
      if (in_array('sfNestedComment', sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfNestedCommentRouting', 'listenToRoutingLoadConfigurationEvent'));
        if (sfNestedCommentConfig::isUsePluginStylesheet())
        {
          $this->dispatcher->connect('context.load_factories', array('sfNestedCommentRouting', 'listenToContextLoadFactoriesEvent'));
        }
      }
      if (in_array('sfNestedCommentAdmin', sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfNestedCommentRouting', 'addRouteForNestedCommentAdmin'));
      }
      sfOutputEscaper::markClassAsSafe('sfNestedCommentsRenderer');
      self::registerHTMLPurifier();
    }
  }

  static public function registerHTMLPurifier()
  {
    if(self::$HTMLPurifierLoaded) {
      return;
    }

    require_once(sfConfig::get('sf_plugins_dir').'/sfNestedCommentPlugin/lib/vendor/htmlpurifier/library/HTMLPurifier/Bootstrap.php');

    spl_autoload_register(array('HTMLPurifier_Bootstrap', 'autoload'));

    self::$HTMLPurifierLoaded = true;
  }
}
