<?php
//based on IoMenuItem.class from IoMenuPlugin

class sfNestedCommentsRenderer implements ArrayAccess, Countable, IteratorAggregate
{
  protected $_comment = null;

  protected $_rootListType = 'ol', $_rootListClass = 'commentlist';
  protected $_childListType = 'ul', $_childListClass = 'children';
  protected $_itemListClass = 'comment';

  protected
    $_children         = array(), // an array of sfNestedCommentsRenderer children
    $_parent           = null;    // parent sfNestedCommentsRenderer

  public function __construct($comment = null, array $options = null)
  {
    sfApplicationConfiguration::getActive()->loadHelpers(array('Tag', 'Date', 'Partial'));

    $this->_comment = $comment;
    if (null !== $options)
    {
      $this->_rootListType = $options['root']['list-type'];
      $this->_rootListClass = $options['root']['list-class'];
      $this->_childListType = $options['child']['list-type'];
      $this->_childListClass = $options['child']['list-class'];
      $this->_itemListClass = $options['item']['list-class'];
    }
  }

  public function isRoot()
  {
    return (bool) !$this->getParent();
  }

  public function getComment()
  {
    return $this->_comment;
  }

  public function setComment($comment)
  {
    $this->_comment = $comment;
    return $this;
  }

  public function addChild($child, $class = null)
  {
    if (!$child instanceof sfNestedCommentsRenderer)
    {
      $child = $this->_createChild($child, $class);
    }
    elseif ($child->getParent())
    {
      throw new sfException('Cannot add menu item as child, it already belongs to another menu (e.g. has a parent).');
    }
    $child->setParent($this);
    $this->_children[$child->getComment()->getPrimaryKey()] = $child;
    return $child;
  }

  protected function _createChild($comment, $class = null)
  {
    if ($class === null)
    {
      $class = get_class($this);
    }
    return new $class($comment);
  }

  public function getChild($key, $create = true)
  {
    if (!isset($this->_children[$key]) && $create)
    {
      $this->addChild($key);
    }
    return isset($this->_children[$key]) ? $this->_children[$key] : null;
  }

  public function getParent()
  {
    return $this->_parent;
  }

  public function setParent(sfNestedCommentsRenderer $parent = null)
  {
    return $this->_parent = $parent;
  }

  public function getChildren()
  {
    return $this->_children;
  }

  public function setChildren(array $children)
  {
    $this->_children = $children;
    return $this;
  }

  public function removeChild($key)
  {
    $key = ($key instanceof sfNestedCommentsRenderer) ? $key->getComment()->getPrimaryKey() : $key;

    if (isset($this->_children[$key]))
    {
      $this->_children[$key]->setParent(null);
      unset($this->_children[$key]);
    }
  }

  public function render($depth = null)
  {
    $html = '';
    if ($depth === 0 || $this->count() == 0)
    {
      return;
    }
    $childDepth = ($depth === null) ? null : ($depth - 1);
    if ($this->isRoot())
    {
      $attributes['class'] = $this->_rootListClass;
      $attributes['id'] = 'commentlist';
      $html .= '<'.$this->_rootListType._tag_options($attributes).'>';
    }
    else
    {
      $attributes['class'] = $this->_childListClass;
      $html .= '<'.$this->_childListType._tag_options($attributes).'>';
    }
    $html .= $this->renderChildren($childDepth);
    if ($this->isRoot())
    {
      $html .= '</'.$this->_rootListType.'>';
    }
    else
    {
      $html .= '</'.$this->_childListType.'>';
    }
    return $html;
  }

  public function __toString()
  {
    return $this->render();
  }

  public function renderChildren($depth = null)
  {
    $html = '';
    foreach ($this->_children as $child)
    {
      $html .= $child->renderChild($depth);
    }
    return $html;
  }

  public function renderChild($depth = null)
  {
    $attributes['class'] = $this->_itemListClass;

    $html = '<li'._tag_options($attributes).'>';
    $html .= $this->renderComment();
    $html .= $this->render($depth);
    $html .= '</li>';
    return $html;
  }

  protected function renderComment()
  {
    return get_partial('sfNestedComment/comment', array('comment' => $this->getComment()));
  }

  public function count()
  {
    return count($this->_children);
  }

  public function getIterator()
  {
    return new ArrayObject($this->_children);
  }

  public function offsetExists($key)
  {
    return isset($this->_children[$key]);
  }

  public function offsetGet($key)
  {
    return $this->getChild($key, false);
  }

  public function offsetSet($key, $value)
  {
    return $this->addChild($key)->setComment($value);
  }

  public function offsetUnset($key)
  {
    $this->removeChild($key);
  }

  public function __call($method, $arguments)
  {
    $name = 'comments.renderer.method_not_found';

    $event = sfProjectConfiguration::getActive()->getEventDispatcher()->notifyUntil(new sfEvent($this, $name, array('method' => $method, 'arguments' => $arguments)));
    if (!$event->isProcessed())
    {
      throw new sfException(sprintf('Call to undefined method %s::%s.', get_class($this), $method));
    }

    return $event->getReturnValue();
  }
}