<?php
class sfNestedCommentAdminForm extends sfNestedCommentForm
{
  public function  configure()
  {
    parent::configure();

    $this->useFields(array('id', 'author_name', 'author_email', 'author_url', 'content', 'sf_comment_id', 'commentable_model', 'commentable_id', 'extra'));

    $this->widgetSchema['author_name'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['author_email'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['author_url'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    
    $this->validatorSchema['content'] = new sfValidatorString(array('required' => true));
    
    $this->widgetSchema['content']->setLabel('Comment (required)');
    
    $this->getWidgetSchema()->setFormFormatterName('comment');
  }

  public function  updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    $user = self::getValidUser()->getProfile();
    $this->setDefault('author_name', $user);
  }
}