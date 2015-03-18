<h1><?php echo __('Move To') ?></h1>
<div><?php echo __('Select Project') ?></div><br>

<form id="moveToForm" action="<?php echo url_for('discussions/moveTo') ?>" method="post">
<?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>
<?php if($sf_request->getParameter('projects_id')>0) echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
<?php echo input_hidden_tag('discussions_id',$sf_request->getParameter('discussions_id')) ?>
<table>
  <tr>
    <td><?php echo __('Move To Project') ?></td>
    <td><?php echo select_tag('move_to','',array('choices'=>Projects::getChoices('discussions',$sf_user)),array('class'=>'required')) ?></td>
  </tr>
  <tr>
    <td></td>
    <td><?php echo __("Note: Destination Project Team should include all Users assigned to selected items.") .'<br>' . __("Users won't have access to Items if they are assigned to these Items but are not in the Project Team")?></td>
  </tr>
</table>

<br>
<input type="submit" value="<?php echo __('Move') ?>" class="btn">

<?php echo input_hidden_tag('selected_items',$sf_request->getParameter('discussions_id')) ?>
</form>

<script>
  set_selected_items();
</script>

<?php include_partial('global/formValidator',array('form_id'=>'moveToForm')); ?>