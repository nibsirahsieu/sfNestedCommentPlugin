<?php
class sfNestedCommentConfig
{
  static public function isCommentEnabled()
  {
    return sfConfig::get('app_sfNestedComment_enabled', true);
  }

  static public function isAjaxEnabled()
  {
    return sfConfig::get('app_sfNestedComment_use_ajax', true);
  }

  static public function getMaxRecentCommet()
  {
    return sfConfig::get('app_sfNestedComment_max_recent', 5);
  }

  static public function getMaxRecentTitleLength()
  {
    return sfConfig::get('app_sfNestedComment_recent_max_title_length', 25);
  }

  static public function isGravatarEnabled()
  {
    return sfConfig::get('app_sfNestedComment_use_gravatar', true);
  }

  static public function isNestedEnabled()
  {
    return self::getNestedDepth() > 0;
  }

  static public function getNestedDepth()
  {
    return sfConfig::get('app_sfNestedComment_nested_depth', 3);
  }

  static public function isPagingEnabled()
  {
    return sfConfig::get('app_sfNestedComment_paging', true);
  }

  static public function getMaxPerPageComment()
  {
    return sfConfig::get('app_sfNestedComment_max_per_page', 5);
  }

  static public function getSortType()
  {
    return sfConfig::get('app_sfNestedComment_sort_type', 'desc');
  }

  static public function isMailEnabled()
  {
    return sfConfig::get('app_sfNestedComment_mail_alert', false);
  }

  static public function getMailAutomoderation()
  {
    return sfConfig::get('app_sfNestedComment_automoderation', 'first_post');
  }

  static public function getMailSender()
  {
    return sfConfig::get('app_sfNestedComment_from_email', '');
  }

  static public function getMaxAttempts()
  {
    return sfConfig::get('app_sfNestedComment_max_attempts', 3);
  }

  static public function getUrlCommentableCallable()
  {
    return sfConfig::get('app_sfNestedComment_url_commentable_method', false);
  }

  static public function getAllowedTags()
  {
    $purifierConfig = sfConfig::get('app_sfNestedComment_purifier');
    return $purifierConfig['allowed_tags'];
  }

  static public function isUsePluginPurifier()
  {
    $purifierConfig = sfConfig::get('app_sfNestedComment_purifier');
    return $purifierConfig['default_package'];
  }
  
  static public function isUsePluginStylesheet()
  {
    return sfConfig::get('app_sfNestedComment_use_packaged_style', true);
  }

  static public function isRecaptchaEnabled()
  {
    return sfConfig::get('app_recaptcha_enabled', false);
  }

  static public function getRecaptchaPublicKey()
  {
    return sfConfig::get('app_recaptcha_public_key');
  }

  static public function getRecaptchaPrivateKey()
  {
    return sfConfig::get('app_recaptcha_private_key');
  }

  static public function isRoutesRegister()
  {
    return sfConfig::get('app_sfNestedComment_routes_register', true);
  }
}