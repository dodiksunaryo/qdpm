<?php echo app::setCssForEmailContent('<h1>'  . link_to($tasks->getProjects()->getName(),'projectsComments/index?projects_id=' . $tasks->getProjectsId(),array('absolute'=>true)) . ': ' .  link_to($tasks->getName(),'tasksComments/index?projects_id=' . $tasks->getProjectsId() . '&tasks_id=' . $tasks->getId(),array('absolute'=>true)) . '</h1>') ?>

<table width="100%">
<tr>
  <td style="vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px;">
    <?php echo  replaceTextToLinks($tasks->getDescription()) ?><br>
    <?php include_component('attachments','attachmentsList',array('bind_type'=>'tasks','bind_id'=>$tasks->getId())) ?>
  </td>
  <td width="30%" valign="top">            
      <?php echo app::setCssForEmailContent('<div>' . get_component('tasks','details',array('tasks'=>$tasks,'is_email'=>true)) . '</div>') ?>    
  </td>
</tr>
</table>