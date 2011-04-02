<?php
class BasesfNestedCommentActions extends sfActions
{
  protected function prepareMailParameter($comment)
  {
    if($comment->getIsModerated())
    {
      $subject_string = 'Please moderate: New comment on "%1%"';
    }
    else
    {
      $subject_string = 'New comment on "%1%"';
    }

    $params = array(
      'subject' => __($subject_string, array(
                    '%1%' => $comment->getCommentableObject()->__toString())),
      'to' => $comment->getCommentableObject()->getAuthorEmail(),
      'from' => sfConfig::get('app_sfNestedComment_from_email', 'no-reply@'.$this->getRequest()->getHost()),
      'message' => array(
        'html' => $this->getPartial('sfNestedCommentMail/commentHtml', array('comment' => $comment)),
        'text' => $this->getPartial('sfNestedCommentMail/commentText', array('comment' => $comment)),
      )
    );
    $event = $this->dispatcher->filter(new sfEvent($this, 'sf_nested_comment.comment.prepare_mail_parameter'), $params);
    return $event->getReturnValue();
  }
  
  public function executeAddComment(sfWebRequest $request)
  {
    $this->commentForm = new sfNestedCommentFrontForm();
    $bindValues = $request->getParameter($this->commentForm->getName());
    if (sfConfig::get('app_recaptcha_enabled', false))
    {
      $captcha = array(
        'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
        'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
      );
      $bindValues = array_merge($bindValues, array('captcha' => $captcha));
    }
    $this->commentForm->bind($bindValues);
    if ($this->commentForm->isValid())
    {
      $commentable = sfNestedCommentableModelQuery::create()->model($this->commentForm->getValues())->findOneOrCreate();
      $commentable->setCommentableId($this->commentForm->getValue('commentable_id'));
      $commentable->setCommentableModel($this->commentForm->getValue('commentable_model'));

      $comment = $this->commentForm->updateObject();
      $automoderation = sfConfig::get('app_sfNestedComment_automoderation', 'first_post');
      if($automoderation === true || (($automoderation == 'first_post') && !sfNestedCommentQuery::create()->isAuthorApproved($comment->getAuthorName(), $comment->getAuthorEmail())))
      {
        $comment->setIsModerated(true);
        $this->getUser()->setFlash('add_comment', 'moderated');
      }
      else
      {
        $this->getUser()->setFlash('add_comment', 'normal');
      }
      $con = Propel::getConnection();
      try
      {
        $con->beginTransaction();
        $commentable->save($con);
        $comment->setSfCommentableModelId($commentable->getId());
        $comment->save($con);
        $con->commit();
      }
      catch (Exception $e)
      {
        $con->rollBack();
        throw $e;
      }

      $this->dispatcher->notify(new sfEvent($this, 'sf_nested_comment.add', array('object' => $comment)));

      $email_pref = sfConfig::get('app_sfNestedComment_mail_alert', false);
      if($email_pref == true || ($email_pref == 'moderated' && $comment->getIsModerated()))
      {
        $params = $this->prepareMailParameter($comment);
        sfNestedCommentTools::sendEmail($this->getMailer(), $params);
      }

      if($request->isXmlHttpRequest())
      {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        $commentableObject = $comment->getCommentableObject();
        $comments = sfNestedCommentTools::getComments($commentableObject, $request);
        return $this->renderPartial('sfNestedComment/comments', array('object' => $commentableObject, 'comments' => $comments, 'commentForm' =>  sfNestedCommentTools::createCommentForm($commentableObject)));
      }
      else
      {
        return $this->redirect($request->getReferer());
      }
    }
    else
    {
      if($request->isXmlHttpRequest())
      {
        $this->getResponse()->setStatusCode(404);
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        return $this->renderPartial('sfNestedComment/add_comment', array('commentForm' => $this->commentForm));
      }
      else
      {
        return 'Error';
      }
    }
  }

  public function executeCommenting(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    $commentableObject = sfNestedCommentTools::getCommentableObject($request->getParameter('commentable_model'), $request->getParameter('commentable_id'));
    $comments = sfNestedCommentTools::getComments($commentableObject, $request);
    return $this->renderPartial('sfNestedComment/comment_list', array('comments' => $comments));
  }
}
