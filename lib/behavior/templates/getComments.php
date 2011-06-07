
/**
 * function to retrieve approved comments level 1
 * @param     $limit max record to retrieve
 * @param     $page page number
 * @return    mixed
 */
public function getApprovedCommentsLevel1($limit = 5, $page = null)
{
  $query = <?php echo $foreignModel.'Query' ?>::create()
    ->approved()
    ->level(1)
    ->sortByCreatedAt()
    ->model($this);
  if (null !== $page) {
    return $query->paginate($page, $limit);
  }
  else {
    return $query->limit($limit)->find();
  }
}

/**
 * function to retrieve approved comments
 * @param     $limit max record to retrieve
 * @param     $page page number
 * @return    mixed
 */
public function getApprovedComments($limit = 5, $page = null)
{
  $query = <?php echo $foreignModel.'Query' ?>::create()
    ->approved()
    ->sortByCreatedAt()
    ->model($this);
  if (null !== $page) {
    return $query->paginate($page, $limit);
  }
  else {
    return $query->limit($limit)->find();
  }
}

/**
 * function to retrieve all comments
 * @param     $limit max record to retrieve
 * @param     $page page number
 * @return    mixed
 */
public function getComments($limit = 5, $page = null)
{
   $query = <?php echo $foreignModel.'Query' ?>::create()
    ->sortByCreatedAt()
    ->model($this);
  if (null !== $page) {
    return $query->paginate($page, $limit);
  }
  else {
    return $query->limit($limit)->find();
  }
}
