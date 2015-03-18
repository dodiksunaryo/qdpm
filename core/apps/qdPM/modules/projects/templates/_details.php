<h2><?php echo __('Details') ?></h2>
<table class="contentTable">
  <tr>
    <th><?php echo __('Id') ?>:</th>
    <td><?php echo $projects->getId() ?></td>
  </tr>
  
  <?php if($projects->getProjectsStatusId()>0) echo '<tr><th>' . __('Status') . ':</th><td>' . $projects->getProjectsStatus()->getName() . '</td></tr>';?>
  <?php if($projects->getProjectsTypesId()>0) echo '<tr><th>' . __('Type') . ':</th><td>' . $projects->getProjectsTypes()->getName() . '</td></tr>';?>
    
  <?php echo ExtraFieldsList::renderInfoFileds('projects',$projects,$sf_user) ?>
  
  <tr><td style="padding-top: 7px;"></td></tr>
  
  <tr>
    <th><?php echo __('Created At') ?>:</th>
    <td><?php echo app::dateTimeFormat($projects->getCreatedAt()) ?></td>
  </tr>  
  <tr>
    <th><?php echo __('Created By') ?>:</th>
    <td><?php echo $projects->getUsers()->getName() ?></td>
  </tr>  
</table>
<br>
<h2><?php echo __('Team') ?></h2>
<table class="contentTable">
<?php
  foreach(explode(',',$projects->getTeam()) as $users_id)
  {
    if($user = Doctrine_Core::getTable('Users')->find($users_id))
    {
      echo '<tr><th><div style="float:left;">' . renderUserPhoto($user->getPhoto())  . '</div>&nbsp;' . $user->getName()  . '<br>'. '</td></tr>';
    }
  }
  if(strlen($projects->getTeam())==0) echo __('No Assigned Users');
?>  
</table>