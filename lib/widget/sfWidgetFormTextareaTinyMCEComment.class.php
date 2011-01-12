<?php
class sfWidgetFormTextareaTinyMCEComment extends sfWidgetFormTextareaTinyMCE
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    $this->addOption('config',
            'plugins : "preview, syntaxhl, preelementfix",
            theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,syntaxhl",
            theme_advanced_buttons2 : "pagebreak,|,preview",
            theme_advanced_buttons3 : "",
            theme_advanced_disable  : "anchor,cleanup,help",
            extended_valid_elements : "textarea[cols|rows|disabled|name|readonly|class]",
            remove_linebreaks       : false"'
          );
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return parent::render($name, $value ? htmlentities($value) : $value, $attributes, $errors);
  }

  public function  getJavaScripts()
  {
    return array('/js/tiny_mce/tiny_mce.js');
  }
}