<?php if(count($tasks_list)>0): ?>
<h2><?php echo __('Related Tasks') ?></h2>

<table>
<?php
$status = array();   
foreach($tasks_list as $tasks): 
if($tasks['tasks_status_id']>0) $status[] = $tasks['tasks_status_id'];
?>
  <tr id="related_task_<?php echo $tasks['id'] ?>">
    <td><?php echo link_to((isset($tasks['TasksLabels'])?$tasks['TasksLabels']['name'] . ': ':'') . $tasks['name'] . (isset($tasks['TasksStatus']) ? ' [' . $tasks['TasksStatus']['name'] . ']':''), 'tasksComments/index?tasks_id=' . $tasks['id'] . '&projects_id=' . $tasks['projects_id'],array('absolute'=>true)) ?></td>
    <td style="text-align: right;"><?php if(!$is_email) echo image_tag('icons/remove_link.png',array('title'=>__('Delete Related'),'style'=>'cursor:pointer','onClick'=>'removeRelated("related_task_' . $tasks['id'] . '","' . url_for('app/removeRelatedTicketWithTask?tasks_id=' . $tasks['id'] . '&tickets_id=' . $sf_request->getParameter('tickets_id')) . '")')) ?></td>
  </tr>  
      
<?php endforeach ?>
</table>

<?php if(Users::hasAccess('insert','tasks',$sf_user,$sf_request->getParameter('projects_id')) and !$is_email): ?>
  <div style="margin-bottom: 10px; margin-top: 5px; text-align: right;"><?php echo link_to_modalbox('+ ' . __('Add'),'tasks/new?related_tickets_id=' . $sf_request->getParameter('tickets_id') . '&projects_id=' . $sf_request->getParameter('projects_id'))?></div>
<?php endif ?>



<?php endif ?>
 