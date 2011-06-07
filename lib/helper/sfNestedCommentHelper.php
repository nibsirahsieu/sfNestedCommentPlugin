<?php
function url_for_commentable_object($commentableObject, $absolute = false)
{
  $callable = sfNestedCommentConfig::getUrlCommentableCallable();
  if ($callable)
  {
    return url_for(call_user_func($callable, $commentableObject), $absolute);
  }
  return false;
}
