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
    $this->widgetSchema['sf_comment_id'] = new sfWidgetFormInputHidden();
  }

  public function updateContentColumn($value)
  {
    return sfNestedCommentTools::clean($value);
  }
}
