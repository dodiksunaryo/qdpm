<h1><?php echo __('Update Selected?') ?></h1>
<div><?php echo __('Just select value if you need to change it') ?></div><br>

<form action="<?php echo url_for('discussions/multipleEdit') ?>" method="post">
<?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>
<?php if($sf_request->getParameter('projects_id')>0) echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
<table>
<?php foreach($fields as $k=>$f): if(count($f['choices'])==0) continue; ?>
  <tr>
    <td><?php echo $f['title'] ?></td>
    <td><?php echo select_tag('fields[' . $k . ']','',array('choices'=>$f['choices'],'multiple'=>(isset($f['multiple'])?true:false),'expanded'=>(isset($f['expanded'])?true:false))) ?></td>
  </tr>
<?php endforeach ?>
</table>

<br>
<input type="submit" value="<?php echo __('Update') ?>" class="btn">

<?php echo input_hidden_tag('selected_items') ?>
</form>

<script>
  set_selected_items();
</script>