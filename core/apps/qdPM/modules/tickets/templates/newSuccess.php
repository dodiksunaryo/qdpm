<h1><?php echo __('New Ticket') ?></h1>


<?php 
  if($sf_request->hasParameter('projects_id'))
  {
    include_partial('form', array('form' => $form));
  }
  elseif(isset($choices['']) and count($choices)==1)
  {
    echo __('Projects Not Found');
  }  
  else
  {              
    echo __('Project') . ': ' . select_tag('form_projects_id','',array('choices'  => $choices),array('onChange'=>'load_form_by_projects_id(\'form_container\',\'' . url_for('tickets/newTicket') . '\',this.value)','style'=>'width:450px;'));
?>

<div style="margin-top: 10px;" id="form_container"></div>

<script type="text/javascript">
  $(document).ready(function(){ 
      load_form_by_projects_id('form_container','<?php echo url_for("tickets/newTicket") ?>',$('#form_projects_id').val());            
  });     
</script>

<?php } ?>
