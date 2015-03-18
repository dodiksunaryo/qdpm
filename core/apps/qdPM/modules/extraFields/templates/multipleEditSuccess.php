<h1><?php echo __('Update Selected?') ?></h1>
<div><?php echo __('Just select value if you need to change it') ?></div><br>

<form action="<?php echo url_for('extraFields/multipleEdit?bind_type=' . $sf_request->getParameter('bind_type')) ?>" method="post">
<table>
  <tr>
    <td><?php echo __('In Listing?') ?></td>
    <td><?php echo select_tag('in_listing','',array('choices'=>array(''=>'','1'=>__('Yes'),'0'=>__('No')))) ?></td>
  </tr>
  <tr>
    <td><?php echo __('Active?') ?></td>
    <td><?php echo select_tag('active','',array('choices'=>array(''=>'','1'=>__('Yes'),'0'=>__('No')))) ?></td>
  </tr>  
</table>

<br>
<input type="submit" value="<?php echo __('Update') ?>" class="btn">

<?php echo input_hidden_tag('selected_items') ?>
</form>

<script>
  set_selected_items();
</script>