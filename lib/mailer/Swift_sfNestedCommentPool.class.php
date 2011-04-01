<?php
class Swift_sfNestedCommentPool extends Swift_PropelSpool
{
  /**
   * Sends messages using the given transport instance.
   *
   * @param Swift_Transport $transport         A transport instance
   * @param string[]        &$failedRecipients An array of failures by-reference
   *
   * @return int The number of sent emails
   */
  public function flushQueue(Swift_Transport $transport, &$failedRecipients = null)
  {
    $queryMethod = $this->method;
    $model = constant($this->model.'::PEER');
    $modelQuery = PropelQuery::from($this->model);
    $objects = $modelQuery->$queryMethod()->limit($this->getMessageLimit())->find();
    
    if (!$transport->isStarted())
    {
      $transport->start();
    }

    $method = 'get'.call_user_func(array($model, 'translateFieldName'), $this->column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
    $count = 0;
    $time = time();
    foreach ($objects as $object)
    {
      $message = unserialize($object->$method());
      try
      {
        $count += $transport->send($message, $failedRecipients);
        $object->mailSent();
      }
      catch (Exception $e)
      {
        $object->mailUnsent();
      }

      if ($this->getTimeLimit() && (time() - $time) >= $this->getTimeLimit())
      {
        break;
      }
    }

    return $count;
  }
}