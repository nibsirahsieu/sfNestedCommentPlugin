# sfNestedCommentPlugin #

The `sfNestedCommentPlugin` is a symfony plugin that enabled the model(s) to be commentable.
Inspired by wordpress commenting system, its support nested comments and enabled by default.
This plugin is for symfony 1.4 and [sfPropel15Plugin](http://www.symfony-project.org/plugins/sfPropel15Plugin).

## Installation ##
  * Install the plugin

        git clone git://github.com/nibsirahsieu/sfNestedCommentPlugin.git

  * Activate the plugin in the `config/ProjectConfiguration.class.php`

        [php]
        class ProjectConfiguration extends sfProjectConfiguration
        {
          public function setup()
          {
            ...
            $this->enablePlugins('...', 'sfNestedCommentPlugin');
            ...
          }
        }

## How to use ##

Add the behavior in your schema. Example:
    <table name="post">
      <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
      <column name="title" type="VARCHAR" required="true" primaryString="true" />
      <column name="content" type="LONGVARCHAR" required="true" />
      <behavior name="commentable" />
    </table>

Rebuild your model:
    > ./symfony propel:build --all-classes

Frontend Usage
-------------

First, activate the module in the settings.yml (apps/your_frontend_app/config/settings.yml)
    enabled_modules:        [..., sfNestedComment]

This plugin comes with two components.

  - **recentComments.**
    This component is used to display the most recent comments. In your template:

        [php]
        <?php include_component('sfNestedComment', 'recentComments') ?>

    The number of comments displayed in this component is controlled by `max_recent` setting.
    In order to make your recent comments clickable, you have to define the `url_commentable_method`.
    
        [yml]
        all:
          sfNestedComment:
            url_commentable_method: [myTools, generatePostUri]

        example:

        [php]
        public static function generatePostUri($post, $postfix = null, $action = 'show')
        {
          if (sfConfig::get('app_sfSimpleBlog_use_date_in_url', false))
          {
            $publishedAt = strtotime($post->getPublishedAt());
            return 'sfSimpleBlog/' . $action . '?' .
              'year='.date('Y', $publishedAt) .
              '&month='.date('m', $publishedAt) .
              '&day='.date('d', $publishedAt) .
              '&stripped_title='.$post->getStrippedTitle() .
              $postfix;
          }
          else
          {
            return 'sfSimpleBlog/' . $action . '?stripped_title=' . $post->getStrippedTitle().$postfix;
          }
        }

    By default, the titles in the recent comments are truncated by 25. You can change it by change the
    value of `recent_max_title_length`.

        [yml]
        all:
          sfNestedComment:
            recent_max_title_length: 30

  - **showComments.**
    This component is used to display the commentable object's comments and comment form. In your template:

        [php]
        <?php include_component('sfNestedComment', 'showComments', array('object' => $post)) ?>

    By default, the comments is displayed in the nested fashion, and it is controlled by `max_depth` setting. You can disabled this feature by set the `max_depth` to 0.

        [yml]
        all:
          sfNestedComment:
            max_depth: 0

    When the user post a comment, the request is done via `Ajax`. You can disable it by set the `use_ajax` to false.

        [yml]
        all:
          sfNestedComment:
            use_ajax: false

    If you want to integrate recaptcha, enabled the recaptcha setting in your `app.yml`. Note, this setting require [sfFormExtraPlugin](http://www.symfony-project.org/plugins/sfFormExtraPlugin)

        [yml]
        all:
          recaptcha:
            enabled: true
            # visit http://recaptcha.net/
            public_key:     your_public_recaptcha_key
            private_key:    your_private_recaptcha_key

    Gravatar is enabled by default, and it is depends on [sfGravatarPlugin](http://www.symfony-project.org/plugins/sfGravatarPlugin), to disable it

        [yml]
        all:
          sfNestedComment:
            use_gravatar: false

Backend Usage
-------------

Activate the module in the settings.yml (apps/your_backend_app/config/settings.yml)
    enabled_modules:        [..., sfNestedCommentAdmin]

Your `myUser.class.php` must provide 4 functions:
    * getId() : Author Id,
    * getName() : Author Name,
    * getEmail() : Author Email,
    * getWebsite() : Author Website.


## Options Configuration ##
  * This plugin provide several options you can customize. See app.yml