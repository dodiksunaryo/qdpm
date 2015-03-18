<?php if(isset($projects) )include_component('projects','shortInfo', array('projects'=>$projects)) ?>

<div class="pageHeading">
<table>
  <tr>
    <td><?php if(isset($projects)) include_component('ticketsComments','goto',array('tickets'=>$tickets,'projects'=>$projects)) ?></td>
    <td><span class="pageHeading"><?php echo  ($tickets->getTicketsTypesId()>0 ? $tickets->getTicketsTypes()->getName(). ': ':'') . $tickets->getName() . ($tickets->getTicketsStatusId()>0 ? ' [' . $tickets->getTicketsStatus()->getName(). '] ':'') ?></span></td>    
    <td><?php if(isset($projects)) include_partial('ticketsComments/gotoNext') ?></td>
  </tr>
</table>
</div>


<table>
  <?php if(Users::hasAccess('insert','ticketsComments',$sf_user,(isset($projects) ? $projects->getId():false))): ?>
    <td style="padding-right: 15px;"><?php echo link_to_modalbox(image_tag('icons/comment_small.png') . ' ' . __('Add Comment'),'ticketsComments/new?tickets_id=' . $tickets->getId() . '&redirect_to=ticketsComments' . (isset($projects) ? '&projects_id=' . $projects->getId():'')) ?></td>
  <?php endif ?>
  
  <?php if(Users::hasAccess('edit','tickets',$sf_user,(isset($projects) ? $projects->getId():false))): ?>
    <td style="padding-right: 15px;"><?php echo link_to_modalbox(image_tag('icons/edit_small.png') . ' ' . __('Edit Details'),'tickets/edit?id=' . $tickets->getId() . '&redirect_to=ticketsComments' . (isset($projects) ? '&projects_id=' . $projects->getId():'')) ?></td>
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
<div class="itemInfo ticketInfo">
  <div class="itemInfoContainer">   
    <div class="itemDescription"><?php echo  replaceTextToLinks($tickets->getDescription()) ?></div>
    <div id="extraFieldsInDescription"><?php echo ExtraFieldsList::renderDescriptionFileds('tickets',$tickets,$sf_user) ?></div>
    <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'tickets','bind_id'=>$tickets->getId())) ?></div>
  </div>
</div>     
<br>
<?php
echo input_hidden_tag('item_name',$tickets->getName()) . input_hidden_tag('item_description',$tickets->getDescription());

$comments_access = Users::getAccessSchema('ticketsComments',$sf_user,(isset($projects) ? $projects->getId():false));
if($comments_access['view']):

$lc = new cfgListingController($sf_context->getModuleName(),'tickets_id=' . $tickets->getId() . (isset($projects) ? '&projects_id=' . $projects->getId():''));
?>


<table width="100%" class="resetPadding">
  <tr>
    <td>
      <table>
        <tr>          
          <td style="padding-right: 15px;"><?php  if($comments_access['insert'])echo $lc->insert_button(__('Add Comment')) ?></td>                    
          <td><?php echo  ((count($tickets_comments)>sfConfig::get('app_rows_per_page'))? get_partial('global/jsPager', array('id'=>'pager')): '') ?></td>
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
    <?php foreach ($tickets_comments as $c): ?>
    <tr>
      <td>
        <?php 
          if($comments_access['edit'] and $comments_access['view_own'])
          {
            if($c['users_id']==$sf_user->getAttribute('id')) echo $lc->action_buttons($c['id']);
          }
          elseif($comments_access['edit'])
          {
            echo $lc->action_buttons($c['id']);
          }
           ?>
      </td>            
      <td style="white-space:normal">
        <?php echo replaceTextToLinks($c['description']) ?>
        <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'ticketsComments','bind_id'=>$c['id'])) ?></div>
        <div><?php include_component('ticketsComments','info',array('c'=>$c)) ?></div>
      </td>
      <td><?php echo app::dateTimeFormat($c['created_at']) . '<br>' . $c['Users']['name'] . '<br>' .renderUserPhoto($c['Users']['photo']) ?></td>      
    </tr>
    <?php endforeach; ?>
    <?php if(count($tickets_comments)==0) echo '<tr><td colspan="3">' . __('No Records Found') . '</td></tr>' ?>
  </tbody>
</table>
<?php if($comments_access['insert']) echo $lc->insert_button(__('Add Comment')); ?>

<script type="text/javascript">
  $(document).ready(function(){ 
    $("#tableListing").tablesorter({widgets: ['zebra']}).tablesorterPager({ container: $("#pager"),size:<?php echo sfConfig::get('app_rows_per_page')?>, positionFixed: false}).tablesorterFilter({filterContainer: "#filter-box",filterClearContainer: "#filter-clear-button"});
    
    $('.email_body').each(function(){  
    
      
    });
    
  });
</script>

<?php endif ?>

  </td>
  <td style="width:27%">
    <div id="itemDetailsContainer">
      <div id="itemDetailsBox">        
        <?php include_component('tickets','details',array('tickets'=>$tickets)) ?>
      </div>
    </div>
  </td>
</tr>
</table>
