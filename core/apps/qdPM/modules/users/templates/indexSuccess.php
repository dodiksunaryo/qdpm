<div class="pageHeading">
<table>
  <tr>
    <td><span class="pageHeading"><?php echo __('Users') ?></span></td>
    <td style="padding-left: 15px;"><?php include_component('users','filters') ?></td>    
    <td style="padding-left: 15px;"><?php include_component('app','searchMenuSimple') ?></td>
  </tr>  
</table>
</div>

<div><?php if(!$sf_request->hasParameter('search')) include_component('users','filtersPreview') ?></div>

<?php
$lc = new cfgListingController($sf_context->getModuleName());

    
  $extra_fields = ExtraFieldsList::getFieldsByType('users',$sf_user,true);
?>


<table width="100%">
  <tr>
    <td>
      <table>
        <tr>          
          <td style="padding-right: 15px;"><?php  echo $lc->insert_button(__('Add User')) ?></td>                    
          <td style="padding-right: 15px;"><?php  echo link_to_mmodalbox(__('Export Selected'),'users/export') ?></td>
          <td><?php echo  ((count($userss)>sfConfig::get('app_rows_per_page'))? get_partial('global/jsPager', array('id'=>'pager')): '') ?></td>
        </tr>
      </table>
    </td>
    <td align="right">
      <form onSubmit="return false">
      <table>
        <tr>
          <td><?php echo __('Quick Search') ?>&nbsp;</td>
          <td><input name="filter" id="filter-box" value="" maxlength="20" size="20" type="text">&nbsp;</td>
          <td><?php echo image_tag('icons/reset.png',array('id'=>'filter-clear-button','title'=>__('Reset'),'class'=>'pointer'))?>&nbsp;</td>                              
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>

<div class="itemsListing usersListing">
  <div class="itemsListingContainer">
  
<table class="tableListing" id="tableListing" style="display:none;">
  <thead>
    <tr>  
      <th class="{sorter: false}" style="width: 20px;"><input name="multiple_selected_all" id="multiple_selected_all" type="checkbox"></th>  
      <th class="{sorter: false}"><div><?php echo __('Action') ?></div></th>
      <th><div><?php echo __('Id') ?></div></th>      
      <th><div><?php echo __('Group') ?></div></th>
      <th><div><?php echo __('Photo') ?></div></th>
      <th width="100%"><div><?php echo __('Name') ?></div></th>      
      <th><div><?php echo __('Email') ?></div></th>  
      
      <?php echo ExtraFieldsList::renderListingThead($extra_fields) ?>
          
      <th><div><?php echo __('Active?') ?></div></th>                      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($userss as $users): ?>
    <tr>
      <td><input name="multiple_selected[]" id="multiple_selected_<?php echo $users->getId() ?>" type="checkbox" value="<?php echo $users->getId() ?>" class="multiple_selected"</td>
      <td><?php echo ($sf_user->getAttribute('id')!= $users->getId() ? $lc->delete_button($users->getId()):'') . $lc->edit_button($users->getId()) ?></td>
      <td><?php echo $users->getId() ?></td>
      <td><?php echo app::getObjectName($users->getUsersGroups())?></td>
      <td><?php echo renderUserPhoto($users->getPhoto()) ?></td>
      <td><?php echo link_to_modalbox($users->getName(),'users/info?id=' . $users->getId()) ?></td>      
      <td><?php echo $users->getEmail() ?></td>  
      
      <?php
        $v = ExtraFieldsList::getValuesList($extra_fields,$users->getId()); 
        echo ExtraFieldsList::renderListingTbody($extra_fields,$v); 
      ?>
                
      <td><?php echo renderBooleanValue($users->getActive()) ?></td>      
    </tr>
    <?php endforeach; ?>
    <?php if(sizeof($userss)==0) echo '<tr><td colspan="100">' . __('No Records Found') . '</td></tr>';?>
  </tbody>
</table>

  </div>
</div>

<?php echo $lc->insert_button(__('Add User')); ?>

<?php if(count($userss)>0){ ?>
<script type="text/javascript">
  $(document).ready(function(){   
    $("#tableListing").css('display','table');    
    $("#tableListing").tablesorter({widgets: ['zebra']}).tablesorterPager({ container: $("#pager"),size:<?php echo sfConfig::get('app_rows_per_page')?>, positionFixed: false}).tablesorterFilter({filterContainer: "#filter-box",filterClearContainer: "#filter-clear-button"});                                      
  });     
</script>
<?php }else{ ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#tableListing").css('display','table');
    $('table.tableListing tbody tr:odd').addClass('odd')
  });
</script>
<?php } ?>  
