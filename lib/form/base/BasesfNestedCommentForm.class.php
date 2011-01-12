<?php

/**
 * sfNestedComment form base class.
 *
 * @method sfNestedComment getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BasesfNestedCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'author_name'       => new sfWidgetFormInputText(),
      'author_email'      => new sfWidgetFormInputText(),
      'author_url'        => new sfWidgetFormInputText(),
      'content'           => new sfWidgetFormTextarea(),
      'is_moderated'      => new sfWidgetFormInputCheckbox(),
      'commentable_model' => new sfWidgetFormInputText(),
      'commentable_id'    => new sfWidgetFormInputText(),
      'user_id'           => new sfWidgetFormInputText(),
      'sf_comment_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfNestedComment', 'add_empty' => true)),
      'extra'             => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'tree_left'         => new sfWidgetFormInputText(),
      'tree_right'        => new sfWidgetFormInputText(),
      'tree_level'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'sfNestedComment', 'column' => 'id', 'required' => false)),
      'author_name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_email'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'           => new sfValidatorString(array('required' => false)),
      'is_moderated'      => new sfValidatorBoolean(array('required' => false)),
      'commentable_model' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'commentable_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'user_id'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'sf_comment_id'     => new sfValidatorPropelChoice(array('model' => 'sfNestedComment', 'column' => 'id', 'required' => false)),
      'extra'             => new sfValidatorString(array('max_length' => 255)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'tree_left'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'tree_right'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'tree_level'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_nested_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfNestedComment';
  }


}
