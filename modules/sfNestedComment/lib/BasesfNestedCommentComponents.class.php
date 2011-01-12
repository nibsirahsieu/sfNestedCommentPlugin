<?php
class BasesfNestedCommentComponents extends sfComponents
{
  public function executeRecentComments()
  {
    $this->comments = sfNestedCommentQuery::create()->
      recent()->
      approved()->
      limit(sfConfig::get('app_sfNestedComment_max_recent', 5))->
      find();
  }
  
  public function executeShowComments(sfWebRequest $request)
  {
    $page = sfConfig::get('app_sfNestedComment_paging', true) ? $request->getParameter('comment-page', 1) : null;
    $this->comments = sfNestedCommentTools::getComments($this->object, $request);
    $this->commentForm = sfNestedCommentTools::createCommentForm($this->object, $request);
  }
}