<h1><?php echo __('Import Spreadsheet (Step 1)')?></h1>

<div><?php echo __('You can import tasks from spreadsheet in xls format.')?></div><br>

<form id="import" action="<?php echo url_for('tools/xlsTasksImport')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sf_method" value="put" />
  <table class="contentTable">
    <tr>
      <td><?php echo __('Project')?></td>
      <td><?php echo select_tag('projects_id',$sf_request->getParameter('project'),array('choices'=>Projects::getChoices('',$sf_user)),array('class'=>'required'))?></td>
    </tr>
    <tr>
      <td><?php echo __('File')?></td>
      <td><input type="file" name="import_file" class="required"></td>
    </tr>
  </table>
    
  <?php echo submit_tag(__('Load file and bind (map) columns to fields')) ?>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'import')); ?>