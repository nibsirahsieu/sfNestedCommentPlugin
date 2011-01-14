<?php
class PluginsfNestedComment extends BasesfNestedComment
{
  protected $commentableObjects = array();

  public function  __toString()
  {
    return $this->getContent();
  }
  
  public function findAndCreateRoot($scope)
  {
    $root = sfNestedCommentQuery::create()->findRoot($scope);
    if (null === $root)
    {
      $root = new sfNestedComment();
      $root->setExtra($scope);
      $root->makeRoot();
    }
    return $root;
  }

  public function preSave(PropelPDO $con = null)
  {
    if (!$this->isReply())
    {
      $root = $this->findAndCreateRoot($this->getExtra());
      if ($this->isNew()) $this->insertAsLastChildOf($root);
    }
    else
    {
      if ($this->isNew())
      {
        $parent = sfNestedCommentQuery::create()->findPk($this->getSfCommentId());
        $this->insertAsLastChildOf($parent);
      }
    }
    return parent::preSave($con);
  }

  public function getApprovedChildren($criteria = null, PropelPDO $con = null)
  {
    $criteria = (null == $criteria) ? new Criteria() : clone $criteria;
    $criteria->add(sfNestedCommentPeer::IS_MODERATED, false);
    $criteria->addDescendingOrderByColumn(sfNestedCommentPeer::CREATED_AT);
    return parent::getChildren($criteria, $con);
  }

  public function getCommentableObject()
  {
    $scope = $this->getExtra();
    if (!isset($this->commentableObjects[$scope]))
    {
      $commentableObject = sfNestedCommentTools::getCommentableObject($this->getCommentableModel(), $this->getCommentableId());
      $this->commentableObjects[$scope] = $commentableObject;
    }
    return $this->commentableObjects[$scope];
  }

  public function isReply()
  {
    return $this->getSfCommentId() ? true : false;
  }

  public function getCommentableTitle()
  {
    return $this->getCommentableObject()->getTitle();
  }
}
