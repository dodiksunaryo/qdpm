<table style="margin-left: 15px;">
  <tr>
    <td>
      <form id="form_goto_previous" action="<?php echo url_for('discussionsComments/index') ?>" method="get">
        <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) . input_hidden_tag('discussions_id') . '<input title="' . __('Go to previous discussion') . '" type="image" src="' . public_path('images/icons/arrows/left.png') . '">' ?>        
      </form>
    </td>
    <td>
      <form id="form_goto_next" action="<?php echo url_for('discussionsComments/index') ?>" method="get">
        <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) . input_hidden_tag('discussions_id') . '<input  title="' . __('Go to next discussion') . '" type="image" src="' . public_path('images/icons/arrows/right.png') . '">' ?>        
      </form>
    </td>
  </tr>
</table>
<script>
  $(function(){
  
    if($('#previous_item_id').val()>0)
    {
      $('#discussions_id',$('#form_goto_previous')).val($('#previous_item_id').val());
    }
    else
    {
      $('#form_goto_previous').css('display','none');
    }
    
    if($('#next_item_id').val()>0)
    {
      $('#discussions_id',$('#form_goto_next')).val($('#next_item_id').val());
    }
    else
    {
      $('#form_goto_next').css('display','none');
    }
  });
</script>