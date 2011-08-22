<?php
class sfNestedCommentFrontForm extends sfNestedCommentForm
{
  public function configure()
  {
    parent::configure();

    $user = $this->getOption('user', null);
    
    if ($user && $user->isAuthenticated()) {
      $this->useFields(array('id', 'author_name', 'author_email', 'author_url', 'content', 'sf_comment_id', 'user_id'));
      
      $this->widgetSchema['author_name'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['author_email'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['author_url'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    } else {
      $this->useFields(array('id', 'author_name', 'author_email', 'author_url', 'content', 'sf_comment_id'));

      $this->widgetSchema['author_name']->setLabel('Name (required)');
      $this->widgetSchema['author_email']->setLabel('Mail (required) (will not be published)');
      $this->widgetSchema['author_url']->setLabel('Website');
    }
    
    $this->validatorSchema['author_name'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['author_email'] = new sfValidatorEmail(array('required' => true));
    $this->validatorSchema['author_url'] = new sfValidatorUrl(array('required' => false));
    $this->validatorSchema['content'] = new sfValidatorString(array('required' => true));
    
    $this->widgetSchema['content']->setAttributes(array('rows' => 10, 'class' => 'resizable'));
    $this->widgetSchema['content']->setLabel('Comment (required)');
    if ($allowedTags = sfNestedCommentConfig::getAllowedTags())
    {
      $this->widgetSchema->setHelp('content', 'You may use these HTML tags and attributes: '.htmlentities(implode(' ', $allowedTags)));
    }

    $this->widgetSchema['commentable_model'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['commentable_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['commentable_model'] = new sfValidatorString();
    $this->validatorSchema['commentable_id'] = new sfValidatorInteger();

    if (sfNestedCommentConfig::isRecaptchaEnabled())
    {
      $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
        'public_key' => sfConfig::get('app_recaptcha_public_key')
      ));

      $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
        'private_key' => sfConfig::get('app_recaptcha_private_key')
      ));
    }
    
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

    $automoderation = sfNestedCommentConfig::getMailAutomoderation();
    if($automoderation === true || (($automoderation == 'first_post') && !sfNestedCommentQuery::create()->isAuthorApproved($this->getObject()->getAuthorName(), $this->getObject()->getAuthorEmail())))
    {
      $this->getObject()->setIsModerated(true);
    }

    $this->getObject()->setsfNestedCommentableModel($commentable);
  }

  protected function  updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    $user = $this->getOption('user');
    
    if ($user && $user->isAuthenticated()) {
      $this->setDefault('user_id', $user->getAuthorId());
      $this->setDefault('author_name', $user->getAuthorName());
      $this->setDefault('author_email', $user->getAuthorEmail());
      $this->setDefault('author_url', $user->getAuthorWebsite());
    }
   }
}
