<?php
class sfNestedCommentFrontForm extends sfNestedCommentForm
{
  public function  configure()
  {
    parent::configure();
    
    $this->useFields(array('id', 'author_name', 'author_email', 'author_url', 'content', 'sf_comment_id'));
    
    $this->validatorSchema['author_name'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['author_email'] = new sfValidatorEmail(array('required' => true));
    $this->validatorSchema['author_url'] = new sfValidatorUrl(array('required' => false));
    $this->validatorSchema['content'] = new sfValidatorString(array('required' => true));
    $this->widgetSchema['content']->setAttribute('rows', 10);
    $this->widgetSchema['author_name']->setLabel('Name (required)');
    $this->widgetSchema['author_email']->setLabel('Mail (required) (will not be published)');
    $this->widgetSchema['author_url']->setLabel('Website');
    $this->widgetSchema['content']->setLabel('Comment (required)');

    $this->widgetSchema['commentable_model'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['commentable_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['commentable_model'] = new sfValidatorString();
    $this->validatorSchema['commentable_id'] = new sfValidatorInteger();
    $this->validatorSchema->setOption('allow_extra_fields', true);
    $this->validatorSchema->setOption('filter_extra_fields', true);

    $this->getWidgetSchema()->setFormFormatterName('comment');
  }
}