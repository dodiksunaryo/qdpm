<h1><?php echo __('Projects Types') ?></h1>
<?php
$lc = new cfgListingController($sf_context->getModuleName());
echo $lc->insert_button() . ' ' .  $lc->sort_button();
?>
<table class="tableListing">
  <thead>
    <tr>
      <th><?php echo __('Action') ?></th>
      <th width="100%"><?php echo __('Name') ?></th>            
      <th><?php echo __('Sort Order') ?></th>
      <th><?php echo __('Active?') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($projects_typess as $projects_types): ?>
    <tr>
      <td><?php echo $lc->action_buttons($projects_types->getId()) ?></td>
      <td><?php echo $projects_types->getName() ?></td>      
      <td><?php echo $projects_types->getSortOrder() ?></td>
      <td><?php echo renderBooleanValue($projects_types->getActive()) ?></td>
    </tr>
    <?php endforeach; ?>
    <?php if(sizeof($projects_typess)==0) echo '<tr><td colspan="5">' . __('No Records Found') . '</td></tr>';?>
  </tbody>
</table>
<?php echo $lc->insert_button(); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>

  

