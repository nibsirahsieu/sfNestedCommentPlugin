
/**
 * function to retrieve approved level 1 comments
 * @param     $page page number
 * @return    mixed
 */
public function getApprovedCommentsLevel1($page = null, $max_per_page = 5)
{
  $query = <?php echo $foreignModel.'Query' ?>::create()->
    approved()->
    level(1)->
    recent()->
    model($this);
  if (null !== $page) return $query->paginate($page, $max_per_page);
  return $query->find();
}

/**
 * function to retrieve approved comments
 * @param     $page page number
 * @return    mixed
 */
public function getApprovedComments($page = null, $max_per_page = 5)
{
  $query = <?php echo $foreignModel.'Query' ?>::create()->
    approved()->
    recent()->
    model($this);
  if (null !== $page) return $query->paginate($page, $max_per_page);
  return $query->find();
}

/**
 * function to retrieve all comments
 * @param     $page page number
 * @return    mixed
 */
public function getComments($page = null, $max_per_page = 5)
{
  return <?php echo $foreignModel.'Query' ?>::create()->
    recent()->
    model($this);
  if (null !== $page) return $query->paginate($page, $max_per_page);
  return $query->find();
}
