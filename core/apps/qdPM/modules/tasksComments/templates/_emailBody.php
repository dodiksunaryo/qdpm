<?php echo app::setCssForEmailContent('<h1>' . link_to($tasks->getProjects()->getName(),'projectsComments/index?projects_id=' . $tasks->getProjectsId(),array('absolute'=>true)) . ': '.  link_to($tasks->getName(),'tasksComments/index?projects_id=' . $tasks->getProjectsId() . '&tasks_id=' . $tasks->getId(),array('absolute'=>true)) . '</h1>') ?>

<table width="100%">
<tr>
  <td style="vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px;">
    
    <table style="width:100%">
    <?php
    $count = 0; 
    foreach ($comments_history as $c): 
    
      if($count==1)
      {
        echo app::setCssForEmailContent('<tr><td colspan="2"><h2>' . __('Previous Comments') . '</h2></td></tr>');
      }
      
      $count++;
    ?>     
        <tr>
          <td style="vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px; border-bottom:1px dashed LightGray">
            <?php echo replaceTextToLinks($c->getDescription()) ?>
            <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'comments','bind_id'=>$c->getId())) ?></div>
            <div><?php include_component('tasksComments','info',array('c'=>$c)) ?></div>
          </td>
          <td style="width:25%; vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px; border-bottom:1px dashed LightGray"><?php echo app::dateTimeFormat($c->getCreatedAt()) . '<br>' . $c->getUsers()->getName() . '<br>' .renderUserPhoto($c->getUsers()->getPhoto()) ?></td>      
        </tr>      
    <?php endforeach; ?>
    </table>
  </td>
  <td width="30%" valign="top">            
      <?php echo app::setCssForEmailContent('<div>' . get_component('tasks','details',array('tasks'=>$tasks,'is_email'=>true)) . '</div>') ?>    
  </td>
</tr>
</table>