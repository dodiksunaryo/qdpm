<h1><?php echo __('Export') ?></h1>

<div><?php echo __('Select fields to export') ?> <?php echo '<a href="#" onClick="return checkAllInContainer(\'extport_fields\')">' . __('Select All') . '</a>' ?><div><br>

<form method="post" action="<?php echo url_for('discussions/export') ?>">
<?php if($sf_request->hasParameter('projects_id')) echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
<div id="extport_fields"><?php echo select_tag('fields',array('name','DiscussionsStatus'),array('choices'=>$columns,'expanded'=>true,'multiple'=>true)) ?></div><br>

<div><?php echo __('Filename') . ': ' .  input_tag('filename',__('Discussions'),array('size'=>40)) ?></div><br>

<div><?php echo __('Format') . ': '. select_tag('format','csv',array('choices'=>array('csv'=>'csv','txt'=>'txt'))) ?></div><br>

<input type="submit" value="<?php echo __('Export') ?>" class="btn">

<?php echo input_hidden_tag('selected_items') ?>
</form>

<script>
  set_selected_items();
</script>