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

  public function recent()
  {
    return $this->orderByCreatedAt(sfConfig::get('app_sfNestedComment_sort_type', 'desc'));
  }

  public function level($level)
  {
    return $this->filterByTreeLevel($level);
  }

  public function model($object)
  {
    return $this->filterByCommentableModel(get_class($object))->filterByCommentableId($object->getPrimaryKey());
  }

  public function isAuthorApproved($name, $email)
  {
    $comment = $this->
      filterByAuthorName($name)->
      filterByAuthorEmail($email)->
      approved()->
      findOne();
      
    return $comment;
  }
}