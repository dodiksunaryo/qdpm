<h1><?php echo __('Tasks Reports') ?></h1>

<?php
$lc = new cfgListingController($sf_context->getModuleName());
echo $lc->insert_button(__('Add Report')) . ' ' .  $lc->sort_button();
?>

<table class="tableListing">
  <thead>
    <tr>
      <th><?php echo __('Action') ?></th>            
      <th width="100%"><?php echo __('Name') ?></th>
      <th><?php echo __('Display on dashboard') ?></th>                              
    </tr>
  </thead>
  <tbody>
    <?php foreach ($user_reportss as $tasks_reports): ?>
    <tr>      
      <td><?php echo $lc->action_buttons($tasks_reports->getId()) ?></td>      
      <td><?php echo link_to($tasks_reports->getName(),'userReports/view?id=' . $tasks_reports->getId()) ?></td>
      <td><?php echo renderBooleanValue($tasks_reports->getDisplayOnHome()) ?></td>                  
    </tr>
    <?php endforeach; ?>
    <?php if(sizeof($user_reportss)==0) echo '<tr><td colspan="4">' . __('No Records Found') . '</td></tr>';?>
  </tbody>
</table>
<?php echo $lc->insert_button(__('Add Report')); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>
