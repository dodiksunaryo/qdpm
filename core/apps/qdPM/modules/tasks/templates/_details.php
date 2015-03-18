<?php if(Users::hasAccess('view','tickets',$sf_user,$sf_request->getParameter('projects_id'))) include_component('tickets','relatedTicketsToTasks',array('tasks_id'=>$tasks->getId(),'is_email'=>isset($is_email))) ?>
<?php if(Users::hasAccess('view','discussions',$sf_user,$sf_request->getParameter('projects_id'))) include_component('discussions','relatedDiscussionsToTasks',array('tasks_id'=>$tasks->getId(),'is_email'=>isset($is_email))) ?>

<h2><?php echo __('Details') ?></h2>
<table class="contentTable">
  <tr>
    <th><?php echo __('Id') ?>:</th>
    <td><?php echo $tasks->getId() ?></td>
  </tr>
  <?php if($tasks->getTasksLabelId()>0) echo '<tr><th>' . __('Label') . ':</th><td>' . $tasks->getTasksLabels()->getName() . '</td></tr>';?>
  <?php if($tasks->getTasksStatusId()>0) echo '<tr><th>' . __('Status') . ':</th><td>' . $tasks->getTasksStatus()->getName() . '</td></tr>';?>
  <?php if($tasks->getClosedDate()) echo '<tr><th>' . __('Closed') . ':</th><td>' . app::dateTimeFormat($tasks->getClosedDate()) . '</td></tr>';?>
  <?php if($tasks->getTasksPriorityId()>0) echo '<tr><th>' . __('Priority') . ':</th><td>' . $tasks->getTasksPriority()->getName() . '</td></tr>';?>
  <?php if($tasks->getTasksTypeId()>0) echo '<tr><th>' . __('Type') . ':</th><td>' . $tasks->getTasksTypes()->getName() . '</td></tr>';?>
  <?php if($tasks->getTasksGroupsId()>0) echo '<tr><th>' . __('Group') . ':</th><td>' . $tasks->getTasksGroups()->getName() . '</td></tr>';?>
  <?php if($tasks->getProjectsPhasesId()>0) echo '<tr><th>' . __('Phase') . ':</th><td>' . $tasks->getProjectsPhases()->getName() . '</td></tr>';?>
  <?php if($tasks->getVersionsId()>0) echo '<tr><th>' . __('Version') . ':</th><td>' . $tasks->getVersions()->getName() . '</td></tr>';?>
    
  <?php echo ExtraFieldsList::renderInfoFileds('tasks',$tasks,$sf_user) ?>
  
  <?php if($tasks->getEstimatedTime()>0) echo '<tr><th>' . __('Estimated Time') . ':</th><td>' . $tasks->getEstimatedTime() . '</td></tr>';?>
  <?php if(($work_hours = TasksComments::getTotalWorkHours($tasks->getId()))>0){ $discrepancy = $tasks->getEstimatedTime()-$work_hours; echo '<tr><th>' . __('Work Hours') . ':</th><td>' . $work_hours  . ($discrepancy<0 ? ' <font color="#a23343">(' . $discrepancy . ')</font>': ($discrepancy>0 ?' <font color="#32602f">(+' . $discrepancy . ')</font>':'')) . '</td></tr>'; } ?>
    
  <?php if($tasks->getStartDate()) echo '<tr><th>' . __('Start Date') . ':</th><td>' . app::dateTimeFormat($tasks->getStartDate()) . '</td></tr>';?>
  <?php if($tasks->getDueDate()) echo '<tr><th>' . __('Due Date') . ':</th><td>' . app::dueDateFormat($tasks->getDueDate()) . '</td></tr>';?>
  <?php if($tasks->getProgress()>0) echo '<tr><th>' . __('Progress') . ':</th><td>' . $tasks->getProgress() . '%</td></tr>';?>
  
  <tr><td style="padding-top: 7px;"></td></tr>
  
  <tr>
    <th><?php echo __('Created At') ?>:</th>
    <td><?php echo app::dateTimeFormat($tasks->getCreatedAt()) ?></td>
  </tr>   
</table>
<br>
<h2><?php echo __('Assigned To') ?></h2>
<table class="contentTable" style="margin-bottom: 7px;">
<?php
  foreach(explode(',',$tasks->getAssignedTo()) as $users_id)
  {
    if($user = Doctrine_Core::getTable('Users')->find($users_id))
    {
      echo '<tr><th><div style="float:left;">' . renderUserPhoto($user->getPhoto())  . '</div>&nbsp;' . $user->getName()  . '<br>'. '</td></tr>';
    }
  }
  
  if(strlen($tasks->getAssignedTo())==0) echo __('No Assigned Users');
?>  
</table>

<h2><?php echo __('Created By') ?></h2>
<table class="contentTable">
<?php
  if($tasks->getCreatedBy()>0)
  {
    echo '<tr><th><div style="float:left;">' . renderUserPhoto($tasks->getUsers()->getPhoto())  . '</div>&nbsp;' . $tasks->getUsers()->getName()  . '<br>'. '</td></tr>';
  }   
?>  
</table>