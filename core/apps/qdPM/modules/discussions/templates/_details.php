<?php if(Users::hasAccess('view','tasks',$sf_user,$sf_request->getParameter('projects_id'))) include_component('tasks','relatedTasksToDiscussions',array('discussions_id'=>$discussions->getId(),'is_email'=>isset($is_email))) ?>

<h2><?php echo __('Details') ?></h2>
<table class="contentTable">
  <tr>
    <th><?php echo __('Id') ?>:</th>
    <td><?php echo $discussions->getId() ?></td>
  </tr>
    
  <?php if($discussions->getDiscussionsStatusId()>0) echo '<tr><th>' . __('Status') . ':</th><td>' . $discussions->getDiscussionsStatus()->getName() . '</td></tr>';?>
      
  <?php echo ExtraFieldsList::renderInfoFileds('discussions',$discussions,$sf_user) ?>
      
  <tr><td style="padding-top: 7px;"></td></tr>       
</table>
<br>
<h2><?php echo __('Assigned To') ?></h2>
<table class="contentTable" style="margin-bottom: 7px;">
<?php
  foreach(explode(',',$discussions->getAssignedTo()) as $users_id)
  {
    if($user = Doctrine_Core::getTable('Users')->find($users_id))
    {
      echo '<tr><th><div style="float:left;">' . renderUserPhoto($user->getPhoto())  . '</div>&nbsp;' . $user->getName()  . '<br>'. '</td></tr>';
    }
  }
  
  if(strlen($discussions->getAssignedTo())==0) echo __('No Assigned Users');
?>  
</table>

<h2><?php echo __('Created By') ?></h2>
<table class="contentTable">
<?php
  if($discussions->getUsersId()>0)
  {
    echo '<tr><th><div style="float:left;">' . renderUserPhoto($discussions->getUsers()->getPhoto())  . '</div>&nbsp;' . $discussions->getUsers()->getName()  . '<br>'. '</td></tr>';
  }   
?>  
</table>