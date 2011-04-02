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
    $allowedTags = sfNestedCommentConfig::getAllowedTags();
    if ($allowedTags)
    {
      $this->widgetSchema->setHelp('content', __('You may use these HTML tags and attributes: ').htmlentities(implode(' ', $allowedTags)));
    }
    
    if (sfConfig::get('app_recaptcha_enabled', false))
    {
      $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
        'public_key' => sfConfig::get('app_recaptcha_public_key')
      ));

      $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
        'private_key' => sfConfig::get('app_recaptcha_private_key')
      ));
    }
    
    $this->widgetSchema['commentable_model'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['commentable_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['commentable_model'] = new sfValidatorString();
    $this->validatorSchema['commentable_id'] = new sfValidatorInteger();
    $this->validatorSchema->setOption('allow_extra_fields', true);
    $this->validatorSchema->setOption('filter_extra_fields', true);

    $this->getWidgetSchema()->setFormFormatterName('comment');
  }
  
  protected function doUpdateObject($values)
  {
    parent::doUpdateObject($values);

    $commentable = sfNestedCommentableModelQuery::create()->model($this->getValues())->findOneOrCreate();
    $commentable->setCommentableId($this->getValue('commentable_id'));
    $commentable->setCommentableModel($this->getValue('commentable_model'));

    $automoderation = sfConfig::get('app_sfNestedComment_automoderation', 'first_post');
    if($automoderation === true || (($automoderation == 'first_post') && !sfNestedCommentQuery::create()->isAuthorApproved($this->getObject()->getAuthorName(), $this->getObject()->getAuthorEmail())))
    {
      $this->getObject()->setIsModerated(true);
    }

    $this->getObject()->setsfNestedCommentableModel($commentable);
  }
}
