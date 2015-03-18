<h1>
  <?php echo link_to_modalbox(image_tag('icons/edit.png',array('title'=>__('Edit Details'))),'projectsReports/edit?id=' .$sf_request->getParameter('id') . '&redirect_to=view') ?>
  <?php echo $projects_reports->getName() ?>
</h1>
<?php include_component('projects','listing',array('reports_id'=>$sf_request->getParameter('id'))) ?>