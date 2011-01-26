<?php

/**
 * sfNestedCommentableModel form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class sfNestedCommentableModelForm extends BasesfNestedCommentableModelForm
{
  public function configure()
  {
    $this->useFields(array('commentable_model', 'commentable_id'));
    $this->widgetSchema['commentable_model'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['commentable_id'] = new sfWidgetFormInputHidden();
  }
}
