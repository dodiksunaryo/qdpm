<?php
  $lc = new listingController('discussions',$url_params,$sf_request,$sf_user);
  $extra_fields = ExtraFieldsList::getFieldsByType('discussions',$sf_user);
  $totals = array();
  
  $is_filter = array();    
  $is_filter['status'] = app::countItemsByTable('DiscussionsStatus');
  
  
  $has_comments_access = Users::hasAccess('view','discussionsComments',$sf_user);
  
?>

<table width="100%">
  <tr>
    <td>
      <table>
        <tr>
          <?php if($display_insert_button): ?>
          <td style="padding-right: 15px;"><?php  echo $lc->insert_button(__('Add Discussion')) ?></td>
          <?php endif ?>
          <td style="padding-right: 15px;"><div id="tableListingMultipleActionsMenu"><?php echo $lc->rednerWithSelectedAction($tlId) ?></div></td>
          <td><?php echo  ((count($discussions_list)>sfConfig::get('app_rows_per_page'))? get_partial('global/jsPager', array('id'=>'pager'. $tlId)): '') ?></td>
        </tr>
      </table>
    </td>
    <td align="right">
      <form onSubmit="return false">
      <table>
        <tr>
          <td><?php echo __('Quick Search') ?>&nbsp;</td>
          <td><input name="filter" id="filter-box<?php echo $tlId ?>" value="" maxlength="20" size="20" type="text">&nbsp;</td>
          <td><?php echo image_tag('icons/reset.png',array('id'=>'filter-clear-button' . $tlId,'title'=>__('Reset'),'class'=>'pointer'))?>&nbsp;</td>                              
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>

<div class="itemsListing discussionsListing">
  <div class="itemsListingContainer">
  
<table class="tableListing" id="tableListing<?php echo $tlId ?>" style="display:none;">
  <thead>
    <tr>
      <?php echo $lc->rednerMultipleSelectTh() ?>
      <?php echo $lc->rednerActionTh() ?> 
      
      <th><div><?php echo __('Id') ?></div></th>
      
      <?php if($is_filter['status']): ?>
      <th><div><?php echo __('Status') ?></div></th>
      <?php endif; ?>
                 
      <th width="100%"><div><?php echo __('Name') ?></div></th>               
      
      <th><div><?php echo __('Created By') ?></div></th>            
                      
      <?php echo ExtraFieldsList::renderListingThead($extra_fields) ?>
      
      <?php if(!$sf_request->hasParameter('projects_id')): ?>
      <th><div><?php echo __('Project') ?></div></th>
      <?php endif; ?> 
    </tr>
  </thead>
  <tbody>
    <?php foreach ($discussions_list as $discussions): ?>
    <tr>
      <?php echo $lc->rednerMultipleSelectTd($discussions['id']) ?>
      <?php echo $lc->renderActionTd($discussions['id'],(!$sf_request->hasParameter('projects_id') ? $discussions['projects_id']:0),false,__('Are you sure you want to delete discussion') . '\n' . $discussions['name'] . '?') ?>
      
      <td><?php echo $discussions['id'] ?></td>
      
      <?php if($is_filter['status']): ?>
      <td><?php echo app::getArrayName($discussions,'DiscussionsStatus') ?></td>
      <?php endif; ?>
                  
      <td>
        <?php echo link_to($discussions['name'],'discussionsComments/index?discussions_id=' . $discussions['id'] . ($discussions['projects_id']>0?'&projects_id=' . $discussions['projects_id']:'')) ?>
        <?php if($has_comments_access) echo  ' '. app::getLastCommentByTable('DiscussionsComments','discussions_id',$discussions['id']) ?> 
      </td>
                  
      <td><?php echo $discussions['Users']['name'] ?></td>            
                                                
      <?php
        $v = ExtraFieldsList::getValuesList($extra_fields,$discussions['id']); 
        echo ExtraFieldsList::renderListingTbody($extra_fields,$v);
        $totals = ExtraFieldsList::getListingTotals($totals, $extra_fields,$v)  
      ?>
      
      <?php if(!$sf_request->hasParameter('projects_id')): ?>
      <td><?php echo link_to(app::getArrayName($discussions,'Projects'),'projectsComments/index?projects_id=' . $discussions['projects_id']) ?></td>
      <?php endif; ?>
    </tr>
    <?php endforeach; ?>        
  </tbody>
  
  <?php if(count($discussions_list)>0 and count($totals)>0): ?>
    <tfoot>
    <tr>
      <td colspan="<?php echo $lc->count_columns($is_filter,4) ?>"></td>
      <?php echo ExtraFieldsList::renderListingTotals($totals,$extra_fields) ?>
      <?php if(!$sf_request->hasParameter('projects_id')) echo '<td></td>' ?>
    </tr>  
    </tfoot>
    <?php endif ?>
    
    <?php if(sizeof($discussions_list)==0) echo '<tr><td colspan="20">' . __('No Records Found') . '</td></tr>';?>
</table>

  </div>
</div>

<?php if($display_insert_button) echo $lc->insert_button(__('Add Discussion')) ?>

<?php include_partial('global/pager', array('total'=>count($discussions_list), 'pager'=>$pager,'url_params'=>($sf_request->getParameter('projects_id')>0 ? 'projects_id=' . $sf_request->getParameter('projects_id'):'') . ($reports_id>0 ? 'id=' . $reports_id:'') ,'page'=>$sf_request->getParameter('page',1),'reports_action'=>'discussionsReports','reports_id'=>$reports_id)) ?>

<?php include_partial('global/jsTips'); ?>

<?php if(count($discussions_list)>0){ ?>
<script type="text/javascript">
  $(document).ready(function(){   
    $("#tableListing<?php echo $tlId ?>").css('display','table');    
    $("#tableListing<?php echo $tlId ?>").tablesorter({widgets: ['zebra']}).tablesorterPager({ container: $("#pager<?php echo $tlId ?>"),size:<?php echo sfConfig::get('app_rows_per_page')?>, positionFixed: false}).tablesorterFilter({filterContainer: "#filter-box<?php echo $tlId ?>",filterClearContainer: "#filter-clear-button<?php echo $tlId ?>"});                                      
  });     
</script>
<?php }else{ ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#tableListing<?php echo $tlId ?>").css('display','table');
    $('table.tableListing<?php echo $tlId ?> tbody tr:odd').addClass('odd')
  });
</script>
<?php } ?>
