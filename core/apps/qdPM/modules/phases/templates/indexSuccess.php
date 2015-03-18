<h1><?php echo __('Default Phases') ?></h1>

<?php
$lc = new cfgListingController($sf_context->getModuleName());
echo $lc->insert_button();
?>

<table class="tableListing">
  <thead>
    <tr>
      <th><?php echo __('Action') ?></th>
      <th width="100%"><?php echo __('Name') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($phasess as $phases): ?>
    <tr>
      <td><?php echo $lc->action_buttons($phases->getId()) ?></td>
      <td><?php echo $phases->getName() ?></td>      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo $lc->insert_button(); ?>

<script type="text/javascript">
  $(document).ready(function(){ $('table.tableListing tbody tr:odd').addClass('odd') });
</script>
