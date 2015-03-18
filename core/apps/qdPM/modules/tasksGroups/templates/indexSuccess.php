<?php include_component('projects','shortInfo', array('projects'=>$projects)) ?>

<h1><?php echo __('Tasks Groups') ?></h1>

<?php
$lc = new cfgListingController($sf_context->getModuleName(),'projects_id=' . $projects->getId());
echo $lc->insert_button(__('Add Group'));
?>

<table class="tableListing">
  <thead>
    <tr>
      <th><?php echo __('Action') ?></th>      
      <th width="100%"><?php echo __('Name') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tasks_groupss as $tasks_groups): ?>
    <tr>
      <td><?php echo $lc->action_buttons($tasks_groups->getId()) ?></td>      
      <td><?php echo $tasks_groups->getName() ?></td>
    </tr>
    <?php endforeach; ?>
    <?php if(sizeof($tasks_groupss)==0) echo '<tr><td colspan="2">' . __('No Records Found') . '</td></tr>';?>
  </tbody>
</table>
<?php echo $lc->insert_button(__('Add Group')); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>
