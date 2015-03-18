<?php if(Users::hasAccess('view','tasks',$sf_user,$sf_request->getParameter('projects_id'))) include_component('tasks','relatedTasksToTickets',array('tickets_id'=>$tickets->getId(),'is_email'=>isset($is_email))) ?>

<h2><?php echo __('Details') ?></h2>
<table class="contentTable">
  <tr>
    <th><?php echo __('Id') ?>:</th>
    <td><?php echo $tickets->getId() ?></td>
  </tr>
  
  <?php if($tickets->getTicketsStatusId()>0) echo '<tr><th>' . __('Status') . ':</th><td>' . $tickets->getTicketsStatus()->getName() . '</td></tr>';?>    
  <?php if($tickets->getTicketsTypesId()>0) echo '<tr><th>' . __('Type') . ':</th><td>' . $tickets->getTicketsTypes()->getName() . '</td></tr>';?>
      
  <?php echo ExtraFieldsList::renderInfoFileds('tickets',$tickets,$sf_user) ?>
    
  <tr><td style="padding-top: 7px;"></td></tr>
      
  <tr>
    <th><?php echo __('Created At') ?>:</th>
    <td><?php echo app::dateTimeFormat($tickets->getCreatedAt()) ?></td>
  </tr>   
</table>
<br>
<h2><?php echo __('Department') ?>: <?php echo $tickets->getDepartments()->getName() ?></h2>
<table class="contentTable" style="margin-bottom: 7px;">
<?php
  if($tickets->getDepartments_id()>0)
  {
    echo '<tr><th><div style="float:left;">' . renderUserPhoto($tickets->getDepartments()->getUsers()->getPhoto())  . '</div>&nbsp;' . $tickets->getDepartments()->getUsers()->getName()  . '<br>'. '</td></tr>';
  }
?>  
</table>

<h2><?php echo __('Created By') ?></h2>
<table class="contentTable">
<?php
  if($tickets->getUsersId()>0)
  {
    echo '<tr><th><div style="float:left;">' . renderUserPhoto($tickets->getUsers()->getPhoto())  . '</div>&nbsp;' . $tickets->getUsers()->getName()  . '<br>'. '</td></tr>';
  }
  else
  {
    echo '<tr><th>' . $tickets->getUserName()  . '<br>' . $tickets->getUserEmail() . '</td></tr>';
  }   
?>  
</table>