<?php

/**
 * sfNestedComment form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class sfNestedCommentForm extends BasesfNestedCommentForm
{
  public function configure()
  {
    $this->widgetSchema['extra'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['sf_comment_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['commentable_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['commentable_model'] = new sfWidgetFormInputHidden();
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    if ($this->isNew())
    {
      $this->setDefault('extra', $this->getObject()->getCommentableModel().$this->getObject()->getCommentableId());
    }
  }

  public function updateContentColumn($value)
  {
    $allowed_html_tags = sfConfig::get('app_sfNestedComment_allowed_tags', array());
    spl_autoload_register(array('HTMLPurifier_Bootstrap', 'autoload'));
    $config = HTMLPurifier_Config::createDefault();
    $config->set('HTML', 'Doctype', 'XHTML 1.0 Strict');
    $config->set('HTML', 'Allowed', implode(',', array_keys($allowed_html_tags)));

    if (isset($allowed_html_tags['a']))
    {
      $config->set('HTML', 'AllowedAttributes', 'a.href');
      $config->set('AutoFormat', 'Linkify', true);
    }

    if (isset($allowed_html_tags['p']))
    {
      $config->set('AutoFormat', 'AutoParagraph', true);
    }

    $purifier = new HTMLPurifier($config);
    return str_replace('<a href', '<a rel="nofollow" href', $purifier->purify($value));
  }
}
