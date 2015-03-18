<?php include_component('projects','shortInfo', array('projects'=>$projects)) ?>

<table class="contentTable" style="width: 100%">
<tr>
  <td>
    <div class="itemInfo projectInfo">
      <div class="itemInfoContainer">
        <div class="itemDescription"><?php echo  replaceTextToLinks($projects->getDescription()) ?></div>
        <div id="extraFieldsInDescription"><?php echo ExtraFieldsList::renderDescriptionFileds('projects',$projects,$sf_user) ?></div>
        <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'projects','bind_id'=>$projects->getId())) ?></div>
      </div>
    </div>
<br>
<?php
$comments_access = Users::getAccessSchema('projectsComments',$sf_user,$projects->getId());
if($comments_access['view']):

$lc = new cfgListingController($sf_context->getModuleName(),'projects_id=' . $sf_request->getParameter('projects_id'));
?>


<table width="100%" class="resetPadding">
  <tr>
    <td>
      <table>
        <tr>          
          <td style="padding-right: 15px;"><?php  if($comments_access['insert'])echo $lc->insert_button(__('Add Comment')) ?></td>                    
          <td><?php echo  ((count($projects_comments)>sfConfig::get('app_rows_per_page'))? get_partial('global/jsPager', array('id'=>'pager')): '') ?></td>
        </tr>
      </table>
    </td>
    <td align="right">
      <form onSubmit="return false">
      <table>
        <tr>
          <td><?php echo __('Search') ?>&nbsp;</td>
          <td><input name="filter" id="filter-box" value="" maxlength="20" size="20" type="text">&nbsp;</td>
          <td><?php echo image_tag('icons/reset.png',array('id'=>'filter-clear-button','title'=>__('Reset'),'class'=>'pointer'))?>&nbsp;</td>                              
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>

<table class="tableListing" id="tableListing">
  <thead>
    <tr>
      <th><?php echo __('Action') ?></th>
      <th width="100%"><?php echo __('Comment') ?></th>
      <th><?php echo __('Created At') ?></th>          
    </tr>
  </thead>
  <tbody>
    <?php foreach ($projects_comments as $c): ?>
    <tr>
      <td>
        <?php 
          if($comments_access['edit'] and $comments_access['view_own'])
          {
            if($c['created_by']==$sf_user->getAttribute('id')) echo $lc->action_buttons($c['id']);
          }
          elseif($comments_access['edit'])
          {
            echo $lc->action_buttons($c['id']);
          }
           ?>
      </td>            
      <td style="white-space:normal">
        <?php echo replaceTextToLinks($c['description']) ?>
        <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'projectsComments','bind_id'=>$c['id'])) ?></div>        
      </td>
      <td><?php echo app::dateTimeFormat($c['created_at']) . '<br>' . $c['Users']['name'] . '<br>' .renderUserPhoto($c['Users']['photo']) ?></td>      
    </tr>
    <?php endforeach; ?>
    <?php if(count($projects_comments)==0) echo '<tr><td colspan="3">' . __('No Records Found') . '</td></tr>' ?>
  </tbody>
</table>
<?php if($comments_access['insert']) echo $lc->insert_button(__('Add Comment')); ?>

<script type="text/javascript">
  $(document).ready(function(){ 
    $("#tableListing").tablesorter({widgets: ['zebra']}).tablesorterPager({ container: $("#pager"),size:<?php echo sfConfig::get('app_rows_per_page')?>, positionFixed: false}).tablesorterFilter({filterContainer: "#filter-box",filterClearContainer: "#filter-clear-button"});
    
    $('pre').bind('click', function() { SelectTextInElement($(this).attr('id')) });
            
  });
</script>

<?php endif ?>

  </td>
  <td style="width:27%">
    <div id="itemDetailsContainer">
      <div id="itemDetailsBox">        
        <?php include_component('projects','details',array('projects'=>$projects)) ?>
      </div>
    </div>
  </td>
</tr>
</table>
