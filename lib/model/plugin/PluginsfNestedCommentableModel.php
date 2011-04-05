<?php
class PluginsfNestedCommentableModel extends BasesfNestedCommentableModel
{
  public function getNbModeratedComments()
  {
    return $this->getNbComments() - $this->getNbApprovedComments();
  }
}