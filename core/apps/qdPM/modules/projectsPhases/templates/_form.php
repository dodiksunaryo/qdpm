<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('projects_id',$sf_request->getParameter('projects_id'))?>

<form id="projectsPhases" action="<?php echo url_for('projectsPhases/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id') )?>
          <input type="submit" value="<?php echo __('Save') ?>" class="btn" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['phases_status_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['phases_status_id']->renderError() ?>
          <?php echo $form['phases_status_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['due_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['due_date']->renderError() ?>
          <?php echo $form['due_date'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'projectsPhases')); ?>

<script type="text/javascript">    
  $(function() {                
    $( "input.datepicker" ).each(function() { $(this).datepicker({ dateFormat: 'yy-mm-dd' }) });                                                                    
  });
</script> 
