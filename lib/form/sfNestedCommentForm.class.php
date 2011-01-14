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
    return sfNestedCommentTools::clean($value);
  }
}
