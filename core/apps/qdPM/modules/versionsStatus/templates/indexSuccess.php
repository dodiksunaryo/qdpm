<h1><?php echo __('Versions Status') ?></h1>
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
    <?php foreach ($versions_statuss as $versions_status): ?>
    <tr>
      <td><?php echo $lc->action_buttons($versions_status->getId()) ?></td>
      <td><?php echo $versions_status->getName() ?></td>
      <td><?php echo renderBooleanValue($versions_status->getDefaultValue()) ?></td>
      <td><?php echo $versions_status->getSortOrder() ?></td>      
      <td><?php echo renderBooleanValue($versions_status->getActive()) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo $lc->insert_button(); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>
