<?php

/**
 * sfNestedComment filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
class sfNestedCommentFormFilter extends BasesfNestedCommentFormFilter
{
  public function configure()
  {
    $this->useFields(array('content', 'is_moderated'));
    $this->widgetSchema['is_moderated']->setLabel('Moderated');
    $this->widgetSchema['content']->setLabel('Comment');
    $this->getWidgetSchema()->setFormFormatterName('list');
  }
}
