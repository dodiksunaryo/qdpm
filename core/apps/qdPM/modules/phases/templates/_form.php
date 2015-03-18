<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="phases" action="<?php echo url_for('phases/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="<?php echo __('Save') ?>" class="btn" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['default_values']->renderLabel() ?></th>
        <td>
          <i><?php echo __('Put phases in new line, for example') . ':<br>Design<br>Development<br>Site Test'; ?></i><br>
          <?php echo $form['default_values']->renderError() ?>
          <?php echo $form['default_values'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'phases')); ?>
