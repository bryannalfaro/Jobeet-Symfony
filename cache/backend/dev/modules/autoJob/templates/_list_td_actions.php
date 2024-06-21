<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_extend">
      <?php echo link_to(__('Extend', array(), 'messages'), 'job/ListExtend?id='.$JobeetJob->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($JobeetJob, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($JobeetJob, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
