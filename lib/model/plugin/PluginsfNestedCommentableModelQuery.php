<?php
class PluginsfNestedCommentableModelQuery extends BasesfNestedCommentableModelQuery
{
  public function model($object)
  {
    if ($object instanceof BaseObject)
    {
      $commentableModel = get_class($object);
      $commentableId = $object->getPrimaryKey();
    }
    else
    {
      $commentableModel = $object['commentable_model'];
      $commentableId = $object['commentable_id'];
    }
    return $this->filterByCommentableModel($commentableModel)
                ->filterByCommentableId($commentableId);
  }
}