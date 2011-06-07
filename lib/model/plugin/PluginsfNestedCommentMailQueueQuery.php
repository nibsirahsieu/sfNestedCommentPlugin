<?php
class PluginsfNestedCommentMailQueueQuery extends BasesfNestedCommentMailQueueQuery
{
  public function spooledMessages()
  {
    return $this
      ->filterBySuccess(false)
      ->filterByAttempts(sfNestedCommentConfig::getMaxAttempts(), Criteria::LESS_EQUAL);
  }
}