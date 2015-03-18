<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="projectsTypes" action="<?php echo url_for('projectsTypes/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table style="width: 100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="<?php echo __('Save') ?>" class="btn" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td>
        
        <?php echo $form->renderGlobalErrors() ?>
        
        <ul class="tabs">
        	<li><a href="#"><?php echo __('General') ?></a></li>        	
        </ul>
        
        <div class="panes">
          <div>
            <table>
              <tr>
                <th><?php echo $form['name']->renderLabel() ?></th>
                <td>
                  <?php echo $form['name']->renderError() ?>
                  <?php echo $form['name'] ?>
                </td>
              </tr>
              <tr>
                <th><?php echo $form['sort_order']->renderLabel() ?></th>
                <td>
                  <?php echo $form['sort_order']->renderError() ?>
                  <?php echo $form['sort_order'] ?>
                </td>
              </tr>

              <tr>
                <th><?php echo $form['active']->renderLabel() ?></th>
                <td>
                  <?php echo $form['active']->renderError() ?>
                  <?php echo $form['active'] ?>
                </td>
              </tr>
              </table>
            </div>          
          </div>
      
        </td>
      </tr>
    </tbody>
  </table>
</form>

<script type="text/javascript">
  $(function() {    
    $("ul.tabs").tabs("div.panes > div");    
  });
</script>

<?php include_partial('global/formValidator',array('form_id'=>'projectsTypes')); ?>