<?php
class BasesfNestedCommentComponents extends sfComponents
{
  public function executeRecentComments()
  {
    $this->comments = sfNestedCommentQuery::create()
      ->recent()
      ->approved()
      ->limit(sfNestedCommentConfig::getMaxRecentCommet())
      ->find();
  }
  
  public function executeShowComments(sfWebRequest $request)
  {
    $page = sfNestedCommentConfig::isPagingEnabled() ? $request->getParameter('comment-page', 1) : null;
    $this->comments = sfNestedCommentTools::getComments($this->object, $request);
    $this->commentForm = sfNestedCommentTools::createCommentForm($this->object);
  }
}