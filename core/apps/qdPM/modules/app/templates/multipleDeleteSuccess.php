<h1><?php echo __('Delete Selected?') ?></h1>

<?php
  switch($sf_request->getParameter('table'))
  {
    case 'projects':
        echo __('Are you sure you want to delete selected projects?') . '<br>' . __('Note: all Projects Tasks, Tickets and Discussions will be deleted as well.');
      break;
    default:
        echo __('Are you sure you want to delete selected items?');
      break;
  } 
   
?>
<br><br>
<form action="<?php echo url_for('app/doMultipleDelete') ?>" method="post">
  <input type="submit" class="btn" value="<?php echo __('Delete')?>">
  <?php echo input_hidden_tag('selected_items') ?>
  <?php echo input_hidden_tag('table',$sf_request->getParameter('table')) ?>
  <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
</form>

<script>
  set_selected_items();
</script>