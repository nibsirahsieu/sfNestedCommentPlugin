<?php
class PluginsfNestedCommentMailQueueQuery extends BasesfNestedCommentMailQueueQuery
{
  public function spooledMessages()
  {
    return $this->filterBySuccess(false)
                ->filterByAttempts(sfConfig::get('app_sfNestedComment_max_attempts', 3), Criteria::LESS_EQUAL);
  }
}