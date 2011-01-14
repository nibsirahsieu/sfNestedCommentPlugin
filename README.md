# sfNestedCommentPlugin #

The `sfNestedCommentPlugin` is a symfony plugin that enabled the model(s) to be commentable. This plugin use sfPropel15Plugin as an ORM.
This plugin support nested comment like you see in the wordpress and inspired by wordpress commenting system.

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
            $this->enablePlugins('sfNestedCommentPlugin');
            ...
          }
        }

## How to use ##
  * Example:

        [xml]
        <table name="section">
          <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
          <column name="title" type="VARCHAR" required="true" primaryString="true" />
          <column name="content" type="LONGVARCHAR" required="true" />
          <behavior name="commentable" />
        </table>

  * Rebuild your model

## Options Configuration ##
  * This plugin provide several options you can customize. See app.yml