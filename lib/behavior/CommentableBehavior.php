<?php

class CommentableBehavior extends Behavior
{
  protected $_foreign_table = 'sf_nested_comment';
  
  public function objectAttributes($builder)
  {
    return $this->renderTemplate('objectAttributes');
  }

  public function objectMethods($builder)
  {
    $script = '';
    $script .= $this->addGetNbComments($builder);
    $script .= $this->AddGetComments($builder);
    $script .= $this->addDeleteComments($builder);
    return $script;
  }

  public function postDelete($builder)
  {
    return "\$this->deleteComments(\$con);";
  }
  
  public function addGetNbComments($builder)
  {
    $foreignModel = $this->getForeignTable()->getPhpName();
    $model = $this->getTable()->getPhpName();
    return $this->renderTemplate('nbComments', array(
       'model' => $model,
       'foreignModel' => $foreignModel,
    ));
  }
  
  public function AddGetComments($builder)
  {
    $foreignModel = $this->getForeignTable()->getPhpName();
    $model = $this->getTable()->getPhpName();
    return $this->renderTemplate('getComments', array(
      'model' => $model,
      'foreignModel' => $foreignModel,
    ));
  }

  public function addDeleteComments($builder)
  {
    $foreignModel = $this->getForeignTable()->getPhpName();
    $model = $this->getTable()->getPhpName();
    return $this->renderTemplate('deleteComments', array(
      'model' => $model,
      'foreignModel' => $foreignModel,
    ));
  }
  
  protected function getForeignTable()
  {
    $database = $this->getTable()->getDatabase();
    return $database->getTable($database->getTablePrefix() . $this->_foreign_table);
  }
}
