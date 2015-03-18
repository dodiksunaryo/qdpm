<h1><?php echo __('Extra fields') . ' (' . __($sf_request->getParameter('bind_type')) . ')' ?></h1>

<?php
$lc = new cfgListingController($sf_context->getModuleName(),'bind_type=' . $sf_request->getParameter('bind_type','projects'));
echo $lc->insert_button() . ' ' .  $lc->sort_button();
?>

<div style="margin-top: 7px;">
<?php echo link_to_mmodalbox(__('Update Selected'),'extraFields/multipleEdit?bind_type=' . $sf_request->getParameter('bind_type')); ?>
</div>

<table   class="tableListing">
  <thead>
    <tr>     
      <th  style="width: 20px;"><input name="multiple_selected_all" id="multiple_selected_all" type="checkbox"></th> 
      <th><?php echo __('Action') ?></th>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Type') ?></th>
      <th width="100%"><?php echo __('Name') ?></th>                        
      <th><?php echo __('In Listing?') ?></th>            
      <th><?php echo __('Active?') ?></th>      
      <th><?php echo __('Sort Order') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($extra_fieldss as $extra_fields): ?>
    <tr>    
      <td><?php echo input_checkbox_tag('multiple_selected[]',$extra_fields->getId(),array('class'=>'multiple_selected'))?></td>
      <td><?php echo $lc->action_buttons($extra_fields->getId()) ?></td>
      <td><?php echo $extra_fields->getId() ?></td>
      <td><?php echo ExtraFields::getTypeNameByKey($extra_fields->getType()) ?></td>
      <td><?php echo $extra_fields->getName() ?></td>                        
      <td><?php echo renderBooleanValue($extra_fields->getDisplayInList()) ?></td>      
      <td><?php echo renderBooleanValue($extra_fields->getActive()) ?></td>                  
      <td><?php echo $extra_fields->getSortOrder() ?></td>
    </tr>
    <?php endforeach; ?>
    <?php if(count($extra_fieldss)==0) echo '<tr><td colspan="10">' . __('No Records Found') . '</td></tr>';?>
  </tbody>
</table>

<?php echo $lc->insert_button(); ?>

<script type="text/javascript">
  $(document).ready(function(){ 
    $('table.tableListing tbody tr:odd').addClass('odd') 
    
    $(".multiple_selected").click(function(){ get_selected_items() })
    
    $('#multiple_selected_all').click(function(){
      selected_items.length = 0;
      $( ".multiple_selected").each(function() { 
        $(this).attr('checked',true);
        selected_items.push($(this).attr('value'));
      });
    })
    
    function get_selected_items(){
      $( ".multiple_selected").each(function() { 
        if($(this).attr('checked'))
        {
          selected_items.push($(this).attr('value'));
        }
      });
    }
  
  });
</script>
