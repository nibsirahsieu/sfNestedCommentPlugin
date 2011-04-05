<?php
class PluginsfNestedCommentQuery extends BasesfNestedCommentQuery
{
  public function moderated()
  {
    return $this->filterByIsModerated(true);
  }

  public function approved()
  {
    return $this->filterByIsModerated(false);
  }

  public function sortByCreatedAt()
  {
    return $this->orderByCreatedAt(sfNestedCommentConfig::getSortType());
  }

  public function recent()
  {
    return $this->orderByCreatedAt('desc');
  }

  public function level($level)
  {
    return $this->filterByTreeLevel($level);
  }

  public function model($object)
  {
    return $this->join('sfNestedComment.sfNestedCommentableModel')
      ->useQuery('sfNestedCommentableModel')
        ->model($object)
      ->endUse();
  }

  public function isAuthorApproved($name, $email)
  {
    $comment = $this
      ->filterByAuthorName($name)
      ->filterByAuthorEmail($email)
      ->approved()
      ->findOne();
      
    return $comment;
  }
}