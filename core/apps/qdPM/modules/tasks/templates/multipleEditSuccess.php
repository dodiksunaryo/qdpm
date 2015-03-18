<h1><?php echo __('Update Selected?') ?></h1>


<form action="<?php echo url_for('tasks/multipleEdit') ?>" method="post">
<?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>
<?php if($sf_request->getParameter('projects_id')>0) echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>

<ul class="tabs">
	<li><a href="#"><?php echo __('Filters') ?></a></li>
	<li><a href="#"><?php echo __('Numeric Fields') ?></a></li>
  
  <?php if(isset($projects)): ?>        	
	<li><a href="#"><?php echo __('Assigned To') ?></a></li>
  <?php endif ?>	
</ul>

<div class="panes">
  <div>
    <div><?php echo __('Just select value if you need to change it.') ?></div><br>
    
    <table>
    <?php foreach($fields as $k=>$f): if(count($f['choices'])==0) continue; ?>
      <tr>
        <td><?php echo $f['title'] ?></td>
        <td><?php echo select_tag('fields[' . $k . ']','',array('choices'=>$f['choices'],'multiple'=>(isset($f['multiple'])?true:false),'expanded'=>(isset($f['expanded'])?true:false))) ?></td>
      </tr>
    <?php endforeach ?>
    </table>
  </div>
  
  <div>
    <div><?php echo __('Enter value if you need to change it.<br>Also you can use: +,-,*,/ to change value.<br>For example: +30 means you increase current value to 30.') ?></div><br>
    <table>
    <?php foreach($numeric_fields as $k=>$f): ?>
      <tr>
        <td><?php echo $f['title'] ?></td>
        <td><?php echo input_tag('fields[' . $k . ']') ?></td>
      </tr>
    <?php endforeach ?>
    </table>
  
  </div>
  
  <?php if(isset($projects)): ?>
  <div>
     <?php echo select_tag('fields[assigned_to]','',array('choices'=>Users::getChoices(array_merge(array($sf_user->getAttribute('id')),array_filter(explode(',',$projects->getTeam()))),'tasks'),'expanded'=>true,'multiple'=>true))?>
  </div>
  <?php endif ?>
</div>

<br>
<input type="submit" value="<?php echo __('Update') ?>" class="btn">

<?php echo input_hidden_tag('selected_items') ?>
</form>

<script>
  set_selected_items();
  $("ul.tabs").tabs("div.panes > div");
</script>