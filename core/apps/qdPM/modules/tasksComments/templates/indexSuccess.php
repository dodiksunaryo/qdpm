<?php include_component('projects','shortInfo', array('projects'=>$projects)) ?>

<?php include_component('tasksComments','breadcrump',array('tasks'=>$tasks)) ?>

<div class="pageHeading">
<table>
  <tr>
    <td><?php include_component('tasksComments','goto',array('tasks'=>$tasks,'projects'=>$projects)) ?></td>
    <td><span class="pageHeading"><?php echo ($tasks->getTasksLabelId()>0 ? $tasks->getTasksLabels()->getName(). ': ':'') . $tasks->getName() . ($tasks->getTasksStatusId()>0 ? ' [' . $tasks->getTasksStatus()->getName(). '] ':'') ?></span></td>    
    <td><?php include_partial('tasksComments/gotoNext') ?></td>
  </tr>
</table>
</div>

<?php $comments_access = Users::getAccessSchema('tasksComments',$sf_user,$projects->getId());?>

<table>  
  <?php if(Users::hasAccess('insert','tasksComments',$sf_user,$projects->getId())): ?>
    <td style="padding-right: 15px;"><?php echo link_to_modalbox(image_tag('icons/comment_small.png') . ' ' . __('Add Comment'),'tasksComments/new?projects_id=' . $projects->getId() . '&tasks_id=' . $tasks->getId() . '&redirect_to=tasksComments') ?></td>
  <?php endif ?>
  
  <?php if(Users::hasAccess('edit','tasks',$sf_user,$projects->getId())): ?>
    <td style="padding-right: 15px;"><?php echo link_to_modalbox(image_tag('icons/edit_small.png') . ' ' . __('Edit Details'),'tasks/edit?projects_id=' . $projects->getId() . '&id=' . $tasks->getId() . '&redirect_to=tasksComments') ?></td>
  <?php endif ?>
  
  <?php if(count($more_actions)>0): ?>
    <td>
      <?php echo renderYuiMenu('more_actions',$more_actions) ?>
      <script type="text/javascript">
        YAHOO.util.Event.onContentReady("more_actions", function () 
        {
            var oMenuBar = new YAHOO.widget.MenuBar("more_actions", {autosubmenudisplay: true,hidedelay: 750,submenuhidedelay: 0,showdelay: 150,lazyload: true });
            oMenuBar.render();
        });
    </script>
    
    </td>
  <?php endif ?>
</table>




<table class="contentTable" style="width: 100%">
<tr>
  <td>
      
<div class="itemInfo taskInfo">
  <div class="itemInfoContainer">    
    <div class="itemDescription"><?php echo  replaceTextToLinks($tasks->getDescription()) ?></div>
    <div id="extraFieldsInDescription"><?php echo ExtraFieldsList::renderDescriptionFileds('tasks',$tasks,$sf_user) ?></div>
    <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'tasks','bind_id'=>$tasks->getId())) ?></div>
  </div>
</div>     
<br>

<?php echo input_hidden_tag('item_name',$tasks->getName()) . input_hidden_tag('item_description',$tasks->getDescription()); ?>

<?php
if($comments_access['view']):

$lc = new cfgListingController($sf_context->getModuleName(),'projects_id=' . $sf_request->getParameter('projects_id') . '&tasks_id=' . $tasks->getId());
?>


<table width="100%" class="resetPadding">
  <tr>
    <td>
      <table>
        <tr>          
          <td style="padding-right: 15px;"><?php  if($comments_access['insert'])echo $lc->insert_button(__('Add Comment')) ?></td>                    
          <td><?php echo  ((count($tasks_comments)>sfConfig::get('app_rows_per_page'))? get_partial('global/jsPager', array('id'=>'pager')): '') ?></td>
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
    <?php foreach ($tasks_comments as $c): ?>
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
        <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'comments','bind_id'=>$c['id'])) ?></div>
        <div><?php include_component('tasksComments','info',array('c'=>$c)) ?></div>
      </td>
      <td><?php echo app::dateTimeFormat($c['created_at']) . '<br>' . $c['Users']['name'] . '<br>' .renderUserPhoto($c['Users']['photo']) ?></td>      
    </tr>
    <?php endforeach; ?>
    <?php if(count($tasks_comments)==0) echo '<tr><td colspan="3">' . __('No Records Found') . '</td></tr>' ?>
  </tbody>
</table>
<?php if($comments_access['insert']) echo $lc->insert_button(__('Add Comment')); ?>

<script type="text/javascript">
  $(document).ready(function(){ 
    $("#tableListing").tablesorter({widgets: ['zebra']}).tablesorterPager({ container: $("#pager"),size:<?php echo sfConfig::get('app_rows_per_page')?>, positionFixed: false}).tablesorterFilter({filterContainer: "#filter-box",filterClearContainer: "#filter-clear-button"});
  });
</script>

<?php endif ?>

  </td>
  <td style="width:27%">
    <div id="itemDetailsContainer">
      <div id="itemDetailsBox">        
        <?php include_component('tasks','details',array('tasks'=>$tasks)) ?>
      </div>
    </div>
  </td>
</tr>
</table>
