
/**
 * function to get the number of comments related to this <?php echo $model ?> class
 * @return    int
 */
public function getNbComments()
{
  if (null === $this->_nb_comments)
  {
    $this->_nb_comments = <?php echo $foreignModel . 'Query'?>::create()->
      model($this)->
      count();
  }
  return $this->_nb_comments;
}

/**
 * function to get the number of approved comments related to this <?php echo $model ?> class
 * @return    int
 */
public function getNbApprovedComments()
{
  if (null === $this->_nb_approved_comments)
  {
    $this->_nb_approved_comments = <?php echo $foreignModel . 'Query'?>::create()->
      model($this)->
      approved()->
      count();
  }
  return $this->_nb_approved_comments;
}
