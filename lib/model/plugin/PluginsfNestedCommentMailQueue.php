<?php
class PluginsfNestedCommentMailQueue extends BasesfNestedCommentMailQueue
{
  public function fail()
  {
    $this->setSuccess(false);
    $this->setAttempts($this->getAttempts() + 1);
    $this->setLastAttempt(time());
    return $this;
  }

  public function success()
  {
    $this->setSuccess(true);
    return $this;
  }
}