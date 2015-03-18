<?php 
if($tickets->getProjectsId()>0)
{
  echo app::setCssForEmailContent('<h1>'  . link_to($tickets->getProjects()->getName(),'projectsComments/index?projects_id=' . $tickets->getProjectsId(),array('absolute'=>true)) . ': ' .  link_to($tickets->getName(),'ticketsComments/index?projects_id=' . $tickets->getProjectsId() . '&tickets_id=' . $tickets->getId(),array('absolute'=>true)) . '</h1>');
}
else
{
  echo app::setCssForEmailContent('<h1>'  .  link_to($tickets->getName(),'ticketsComments/index?tickets_id=' . $tickets->getId(),array('absolute'=>true)) . '</h1>');
}   
  
?>

<table width="100%">
<tr>
  <td style="vertical-align: top; font-family:  Arial; font-size: 13px; color: black; padding: 2px;">
    <?php echo  replaceTextToLinks($tickets->getDescription()) ?><br>
    <div><?php echo ExtraFieldsList::renderDescriptionFileds('tickets',$tickets,$sf_user) ?></div>
    <?php include_component('attachments','attachmentsList',array('bind_type'=>'tickets','bind_id'=>$tickets->getId())) ?>
  </td>
  <td width="30%" valign="top">            
      <?php echo app::setCssForEmailContent('<div>' . get_component('tickets','details',array('tickets'=>$tickets,'is_email'=>true)) . '</div>') ?>    
  </td>
</tr>
</table>