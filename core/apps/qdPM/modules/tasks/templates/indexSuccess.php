<?php if($sf_request->hasParameter('projects_id')) include_component('projects','shortInfo', array('projects'=>$projects)) ?>

<div class="pageHeading">
<table>
  <tr>
    <td><span class="pageHeading"><?php echo __('Tasks') ?></span></td>      
    <td style="padding-left: 15px;"><?php include_component('tasks','filters') ?></td>    
    <td style="padding-left: 15px;"><?php include_component('app','orderByMenu',array('module'=>'tasks')) ?></td>           
    <td style="padding-left: 15px;"><?php include_component('app','searchMenu') ?></td>
  </tr>  
</table>
</div>

<div><?php if(!$sf_request->hasParameter('search')) include_component('tasks','filtersPreview') ?></div>

<?php 
  include_component('tasks','listing');
?>
