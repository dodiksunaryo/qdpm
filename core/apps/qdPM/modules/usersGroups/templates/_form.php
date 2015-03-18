<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="usersGroups" action="<?php echo url_for('usersGroups/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table style="width:100%">
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
        
          <table>
            <tr>
              <th><?php echo $form['name']->renderLabel() ?></th>
              <td>
                <?php echo $form['name']->renderError() ?>
                <?php echo $form['name'] ?>
              </td>
            </tr>

          </table>
        
        <?php echo $form->renderGlobalErrors() ?>
        
        <ul class="tabs">
        	<li><a href="#"><?php echo __('Basic Access') ?></a></li>
        	<li><a href="#"><?php echo __('Extra Access Configuration') ?></a></li>        	
        </ul>
    
      <div class="panes">
          <div>
            <table>              
              <tr>
                <th><?php echo $form['allow_manage_projects']->renderLabel() ?></th>
                <td>
                  <?php echo $form['allow_manage_projects']->renderError() ?>
                  <?php echo $form['allow_manage_projects'] ?>
                  
                </td>
              </tr>
              <tr>
                <th><?php echo $form['allow_manage_tasks']->renderLabel() ?></th>
                <td>
                  <?php echo $form['allow_manage_tasks']->renderError() ?>
                  <?php echo $form['allow_manage_tasks'] ?>

                </td>
              </tr>
              <tr>
                <th><?php echo $form['allow_manage_tickets']->renderLabel() ?></th>
                <td>
                  <?php echo $form['allow_manage_tickets']->renderError() ?>
                  <?php echo $form['allow_manage_tickets'] ?>

                </td>
              </tr>
              <tr>
                <th><?php echo $form['allow_manage_discussions']->renderLabel() ?></th>
                <td>
                  <?php echo $form['allow_manage_discussions']->renderError() ?>
                  <?php echo $form['allow_manage_discussions'] ?>

                </td>
              </tr>
              </table>
              </div>
              
              <div>
              <table>
              <tr>
                <th><?php echo $form['allow_manage_configuration']->renderLabel() ?></th>
                <td>
                  <?php echo $form['allow_manage_configuration']->renderError() ?>
                  <?php echo $form['allow_manage_configuration'] ?>
                </td>
              </tr>
              <tr>
                <th><?php echo $form['allow_manage_users']->renderLabel() ?></th>
                <td>
                  <?php echo $form['allow_manage_users']->renderError() ?>
                  <?php echo $form['allow_manage_users'] ?>
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

<?php include_partial('global/formValidator',array('form_id'=>'usersGroups')); ?>
