<?php
function url_for_commentable_object($commentableObject, $absolute = false)
{
  $callable = sfConfig::get('app_sfNestedComment_url_commentable_method', false);
  if ($callable)
  {
    return url_for(call_user_func($callable, $commentableObject), $absolute);
  }
  return false;
}

function url_for_commentable_object_app($commentableObject, $appname, $absolute = false, $env = null, $debug = false)
{
  $callable = sfConfig::get('app_sfNestedComment_url_commentable_method', false);
  if ($callable)
  {
    return url_for_app($appname, call_user_func($callable, $commentableObject), $absolute, $env, $debug);
  }
  return false;
}

function url_for_app($appname, $url, $absolute = false, $env = null, $debug = false)
{
  require_once(sfConfig::get('sf_plugins_dir') . '/omCrossAppUrlPlugin/lib/helper/crossAppLinkHelper.php');
  
  return cross_app_url_for($appname, $url, $absolute, $env, $debug);
}