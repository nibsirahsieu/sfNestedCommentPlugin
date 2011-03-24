
/**
 * function to delete related comments
 * @param     PropelPDO $con
 * @return    int The number of rows affected
 */
public function deleteComments(PropelPDO $con)
{
  $comments = <?php echo $foreignModel.'Query' ?>::create()
    ->model($this)
    ->find($con);
  try
  {
    $con->beginTransaction();
    foreach ($comments as $comment)
    {
      $comment->delete($con);
    }
    $con->commit();
  }
  catch (Exception $e)
  {
    $con->rollBack();
    throw $e;
  }
}

