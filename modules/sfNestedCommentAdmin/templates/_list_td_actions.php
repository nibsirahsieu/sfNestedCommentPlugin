<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($sf_nested_comment, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_togglepublish">
      <?php $approvedText = $sf_nested_comment->getIsModerated() ? 'Approve' : 'Unapprove' ?>
      <?php echo link_to(__($approvedText, array(), 'messages'), 'sfNestedCommentAdmin/togglePublish?id='.$sf_nested_comment->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_reply">
      <?php echo link_to(__('Reply', array(), 'messages'), 'sfNestedCommentAdmin/new?id='.$sf_nested_comment->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToDelete($sf_nested_comment, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
