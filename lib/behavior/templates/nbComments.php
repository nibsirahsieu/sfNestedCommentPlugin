
/**
 * Get the associated CommentCounter (sfNestedCommentableModel) object
 *
 * @param      PropelPDO Optional Connection object.
 * @return     sfNestedCommentableModel The associated sfNestedCommentableModel object.
 * @throws     PropelException
 */
public function getCommentCounter(PropelPDO $con = null)
{
  if ($this->aCommentCounter === null && ($this->getPrimaryKey() !== null)) {
    $this->aCommentCounter = sfNestedCommentableModelQuery::create()->model($this)->findOne($con);
  }
  return $this->aCommentCounter;
}
  
/**
 * function to get the number of comments related to this <?php echo $model ?> class
 * @return    int
 */
public function getNbComments()
{
  return $this->getCommentCounter()->getNbComments();
}

/**
 * function to get the number of approved comments related to this <?php echo $model ?> class
 * @return    int
 */
public function getNbApprovedComments()
{
  return $this->getCommentCounter()->getNbApprovedComments();
}
