<table style="margin-left: 15px;">
  <tr>
    <td>
      <form id="form_goto_previous" action="<?php echo url_for('ticketsComments/index') ?>" method="get">
        <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) . input_hidden_tag('tickets_id') . '<input title="' . __('Go to previous ticket') . '" type="image" src="' . public_path('images/icons/arrows/left.png') . '">' ?>        
      </form>
    </td>
    <td>
      <form id="form_goto_next" action="<?php echo url_for('ticketsComments/index') ?>" method="get">
        <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) . input_hidden_tag('tickets_id') . '<input  title="' . __('Go to next ticket') . '" type="image" src="' . public_path('images/icons/arrows/right.png') . '">' ?>        
      </form>
    </td>
  </tr>
</table>
<script>
  $(function(){
  
    if($('#previous_item_id').val()>0)
    {
      $('#tickets_id',$('#form_goto_previous')).val($('#previous_item_id').val());
    }
    else
    {
      $('#form_goto_previous').css('display','none');
    }
    
    if($('#next_item_id').val()>0)
    {
      $('#tickets_id',$('#form_goto_next')).val($('#next_item_id').val());
    }
    else
    {
      $('#form_goto_next').css('display','none');
    }
  });
</script>