<?php
class sfNestedCommentFrontForm extends sfNestedCommentForm
{
  public function  configure()
  {
    parent::configure();
    
    $this->useFields(array('id', 'author_name', 'author_email', 'author_url', 'content', 'sf_comment_id', 'commentable_model', 'commentable_id', 'extra'));
    
    $this->validatorSchema['author_name'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['author_email'] = new sfValidatorEmail(array('required' => true));
    $this->validatorSchema['author_url'] = new sfValidatorUrl(array('required' => false));
    $this->validatorSchema['content'] = new sfValidatorString(array('required' => true));
    $this->widgetSchema['content']->setAttribute('rows', 10);
    $this->widgetSchema['author_name']->setLabel('Name (required)');
    $this->widgetSchema['author_email']->setLabel('Mail (required) (will not be published)');
    $this->widgetSchema['author_url']->setLabel('Website');
    $this->widgetSchema['content']->setLabel('Comment (required)');

    $allowed_html_tags = sfConfig::get('app_sfNestedComment_allowed_tags', array());
    if (!empty($allowed_html_tags))
    {
      $help = '<p class="form-allowed-tags">You may use these HTML tags and attributes : <code>';
      foreach ($allowed_html_tags as $tag)
      {
        $help .= htmlentities($tag).' ';
      }
      $help .= '</p>';
      $this->widgetSchema['content']->getParent()->setHelp('content', $help);
    }
    
    $this->getWidgetSchema()->setFormFormatterName('comment');
  }
}