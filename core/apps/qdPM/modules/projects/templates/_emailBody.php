<?php echo app::setCssForEmailContent('<h1>' .  link_to($projects->getName(),'projectsComments/index?projects_id=' . $projects->getId(),array('absolute'=>true)) . '</h1>') ?>

<table width="100%">
<tr>
  <td style="vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px;">
    <?php echo  replaceTextToLinks($projects->getDescription()) ?><br>
    <?php include_component('attachments','attachmentsList',array('bind_type'=>'projects','bind_id'=>$projects->getId())) ?>
  </td>
  <td width="30%" valign="top">            
      <?php echo app::setCssForEmailContent('<div>' . get_component('projects','details',array('projects'=>$projects)) . '</div>') ?>    
  </td>
</tr>
</table>