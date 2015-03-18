<h1><?php echo __('Departments') ?></h1>
<?php
$lc = new cfgListingController($sf_context->getModuleName());
echo $lc->insert_button() . ' ' .  $lc->sort_button();
?>
<table class="tableListing">
  <thead>
    <tr>      
      <th><?php echo __('Action') ?></th>
      <th width="100%"><?php echo __('Name') ?></th>
      <th><?php echo __('Assigned To') ?></th>
      <th><?php echo __('Sort Order') ?></th>
      <th><?php echo __('Active') ?></th>
            
    </tr>
  </thead>
  <tbody>
    <?php foreach ($departmentss as $departments): ?>
    <tr>
      <td><?php echo $lc->action_buttons($departments->getId()) ?></td>
      <td><?php echo $departments->getName() ?></td>     
      <td><?php echo $departments->getUsers()->getName() ?></td>       
      <td><?php echo $departments->getSortOrder() ?></td>      
      <td><?php echo renderBooleanValue($departments->getActive()) ?></td>      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo $lc->insert_button(); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>
