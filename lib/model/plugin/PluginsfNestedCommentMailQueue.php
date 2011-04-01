<?php
class PluginsfNestedCommentMailQueue extends BasesfNestedCommentMailQueue
{
  public function mailUnsent()
  {
    $this->setSuccess(false);
    $this->setAttempts($this->getAttempts() + 1);
    $this->setLastAttempt(time());
    $this->save();
  }

  public function mailSent()
  {
    $this->setSuccess(true);
    $this->save();
  }
}