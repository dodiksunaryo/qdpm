<h1><?php echo __('Bind Field')?></h1>

<form id="bind_filed" action="<?php url_for('tools/xlsTasksImportBindField') ?>" method="post">
<?php 
  echo '<input name="field_id" type="radio" value="0" id="field_id_0" checked="checked"> <label for="field_id_0">' . __('None') . '</label><br>';

  echo '<div id="extport_fields">' . select_tag('field_id','',array('choices'=>$columns,'expanded'=>true,'multiple'=>false)) . '</div>';
  echo input_hidden_tag('col',$sf_request->getParameter('col'));
?>

<br>
<input type="button" class="btn" value="<?php echo __('Bind Field') ?>" onClick="bindField(<?php echo $sf_request->getParameter('col') ?>)">

</form>