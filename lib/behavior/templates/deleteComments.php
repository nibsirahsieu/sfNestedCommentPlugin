
/**
 * function to delete related comments
 * @param     PropelPDO $con
 * @return    int The number of rows affected
 */
public function deleteComments(PropelPDO $con)
{
  return <?php echo $foreignModel.'Query' ?>::create()->
    model($this)->
    doDelete($con);
}
