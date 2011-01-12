<?php

require_once dirname(__FILE__).'/sfNestedCommentAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/sfNestedCommentAdminGeneratorHelper.class.php';

class BasesfNestedCommentAdminActions extends autoSfNestedCommentAdminActions
{
  public function executeTogglePublish(sfWebRequest $request)
  {
    $comment = $this->getRoute()->getObject();
    $comment->setIsModerated(!$comment->getIsModerated());
    $comment->save();
    $this->redirect('@sf_nested_comment');
  }

  public function executeNew(sfWebRequest $request)
  {
    $profile = $this->getUser()->getProfile();
    $this->parent_comment = $this->getRoute()->getObject();
    $this->sf_nested_comment = new sfNestedComment();
    $this->sf_nested_comment->setSfCommentId($this->parent_comment->getId());
    $this->sf_nested_comment->setCommentableModel($this->parent_comment->getCommentableModel());
    $this->sf_nested_comment->setCommentableId($this->parent_comment->getCommentableId());
    $this->sf_nested_comment->setExtra($this->parent_comment->getExtra());
    $this->sf_nested_comment->setUserId($this->getUser()->getGuardUser()->getId());
    $this->sf_nested_comment->setAuthorName($profile->getFirstName().' '.$profile->getLastName());
    $this->sf_nested_comment->setAuthorEmail($profile->getEmail());
    $this->sf_nested_comment->setAuthorUrl($profile->getWebsite());
    $this->form = $this->configuration->getForm($this->sf_nested_comment);
    $this->form->setWidget('author_name', new sfWidgetFormInputHidden(array(), array()));
    $this->form->setWidget('author_email', new sfWidgetFormInputHidden(array(), array()));
    $this->form->setWidget('author_url', new sfWidgetFormInputHidden(array(), array()));
    $this->form->setWidget('content', new sfWidgetFormTextareaTinyMCE(array(  'theme' => 'simple',), array(  'rows' => 5,  'cols' => 80,)));
    $this->form->setWidget('user_id', new sfWidgetFormInputHidden(array(), array()));
    unset($this->form['is_moderated']);
    unset($this->form['created_at']);
    unset($this->form['updated_at']);
    unset($this->form['tree_left']);
    unset($this->form['tree_right']);
    unset($this->form['tree_level']);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $isNew = $form->getObject()->isNew();
      $notice = $isNew ? 'Your reply was saved successfully.' : 'The item was updated successfully.';

      $sf_nested_comment = $form->save();

      if ($isNew && sfConfig::get('app_sfNestedComment_mail_alert', false) && $sf_nested_comment->isReply())
      {
        $userComment = $sf_nested_comment->getsfNestedCommentRelatedBySfCommentId();
        $subject_string = '%1% replied to your comment on "%2%"';
        $params = array(
            'subject' => __($subject_string, array(
                          '%1%' => $sf_nested_comment->getAuthorName(),
                          '%2%' => $sf_nested_comment->getCommentableObject()->getTitle())),
            'to' => $userComment->getAuthorEmail(),
            'from' => sfConfig::get('app_sfNestedComment_from_email', 'no-reply@'.$request->getHost()),
            'message' => array(
              'html' => $this->getPartial('sfNestedCommentMail/replyHtml', array('reply' => $sf_nested_comment, 'comment' => $userComment)),
              'text' => $this->getPartial('sfNestedCommentMail/replyText', array('reply' => $sf_nested_comment, 'comment' => $userComment)),
            )
        );
        $event = $this->dispatcher->filter(new sfEvent($this, 'reply.prepare_mail_parameter'), $params);
        $params = $event->getReturnValue();

        sfNestedCommentTools::sendEmail($this->getMailer(), $params);
      }
      
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $sf_nested_comment)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@sf_nested_comment_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'sf_nested_comment_edit', 'sf_subject' => $sf_nested_comment));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}