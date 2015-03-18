<?php echo app::setCssForEmailContent('<h1>'  . link_to($discussions->getProjects()->getName(),'projectsComments/index?projects_id=' . $discussions->getProjectsId(),array('absolute'=>true)) . ': ' .  link_to($discussions->getName(),'discussionsComments/index?projects_id=' . $discussions->getProjectsId() . '&discussions_id=' . $discussions->getId(),array('absolute'=>true)) . '</h1>') ?>

<table width="100%">
<tr>
  <td style="vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px;">
    <?php echo  replaceTextToLinks($discussions->getDescription()) ?><br>
    <?php include_component('attachments','attachmentsList',array('bind_type'=>'discussions','bind_id'=>$discussions->getId())) ?>
  </td>
  <td width="30%" valign="top">            
      <?php echo app::setCssForEmailContent('<div>' . get_component('discussions','details',array('discussions'=>$discussions,'is_email'=>true)) . '</div>') ?>    
  </td>
</tr>
</table>