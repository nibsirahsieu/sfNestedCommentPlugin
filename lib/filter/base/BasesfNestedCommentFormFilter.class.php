<?php

/**
 * sfNestedComment filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BasesfNestedCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'author_name'       => new sfWidgetFormFilterInput(),
      'author_email'      => new sfWidgetFormFilterInput(),
      'author_url'        => new sfWidgetFormFilterInput(),
      'content'           => new sfWidgetFormFilterInput(),
      'is_moderated'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'commentable_model' => new sfWidgetFormFilterInput(),
      'commentable_id'    => new sfWidgetFormFilterInput(),
      'user_id'           => new sfWidgetFormFilterInput(),
      'sf_comment_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfNestedComment', 'add_empty' => true)),
      'extra'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tree_left'         => new sfWidgetFormFilterInput(),
      'tree_right'        => new sfWidgetFormFilterInput(),
      'tree_level'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'author_name'       => new sfValidatorPass(array('required' => false)),
      'author_email'      => new sfValidatorPass(array('required' => false)),
      'author_url'        => new sfValidatorPass(array('required' => false)),
      'content'           => new sfValidatorPass(array('required' => false)),
      'is_moderated'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'commentable_model' => new sfValidatorPass(array('required' => false)),
      'commentable_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sf_comment_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfNestedComment', 'column' => 'id')),
      'extra'             => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tree_left'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tree_right'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tree_level'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sf_nested_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfNestedComment';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'author_name'       => 'Text',
      'author_email'      => 'Text',
      'author_url'        => 'Text',
      'content'           => 'Text',
      'is_moderated'      => 'Boolean',
      'commentable_model' => 'Text',
      'commentable_id'    => 'Number',
      'user_id'           => 'Number',
      'sf_comment_id'     => 'ForeignKey',
      'extra'             => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'tree_left'         => 'Number',
      'tree_right'        => 'Number',
      'tree_level'        => 'Number',
    );
  }
}
