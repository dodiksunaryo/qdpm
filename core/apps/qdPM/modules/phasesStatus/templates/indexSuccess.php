<h1><?php echo __('Phase Status') ?></h1>
<?php
$lc = new cfgListingController($sf_context->getModuleName());
echo $lc->insert_button() . ' ' .  $lc->sort_button();
?>
<table class="tableListing">
  <thead>
    <tr>
      <th><?php echo __('Action') ?></th>
      <th width="100%"><?php echo __('Name') ?></th>
      <th><?php echo __('Default?') ?></th>      
      <th><?php echo __('Sort Order') ?></th>
      <th><?php echo __('Active?') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($phases_statuss as $phases_status): ?>
    <tr>
      <td><?php echo $lc->action_buttons($phases_status->getId()) ?></td>
      <td><?php echo $phases_status->getName() ?></td>
      <td><?php echo renderBooleanValue($phases_status->getDefaultValue()) ?></td>
      <td><?php echo $phases_status->getSortOrder() ?></td>      
      <td><?php echo renderBooleanValue($phases_status->getActive()) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo $lc->insert_button(); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>
