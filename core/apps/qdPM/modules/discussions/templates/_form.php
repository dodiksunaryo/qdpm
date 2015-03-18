<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('projects_id',$sf_request->getParameter('projects_id')) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('users_id',$sf_user->getAttribute('id')) ?>
<?php if(!$form->getObject()->isNew()) $form->setDefault('assigned_to',explode(',',$form['assigned_to']->getValue())) ?>

<form id="discussions" action="<?php echo url_for('discussions/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php include_component('app','copyToRelated',array('form_name'=>'discussions')) ?>

  <table style="width: 100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
          <?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>                    
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
        	<li><a href="#"><?php echo __('Attachments') ?></a></li>
        </ul>
        
        <div class="panes">
          <div>         
            <table>    
              <?php if(app::countItemsByTable('DiscussionsStatus')>0): ?>
              <tr>
                <th><?php echo $form['discussions_status_id']->renderLabel() ?></th>
                <td>
                  <?php echo $form['discussions_status_id']->renderError() ?>
                  <?php echo $form['discussions_status_id'] ?>
                </td>
              </tr>
              <?php endif ?>

              <tr>
                <th><?php echo $form['assigned_to']->renderLabel() ?><br><a href="#" onClick="return checkAllInContainer('assigned_to')"><small><?php echo __('Select All')?></small></a></th>
                <td>
                  <?php echo $form['assigned_to']->renderError() ?>
                  <div id="assigned_to" class="checkboxesList"><?php echo $form['assigned_to'] ?></div>
                </td>
              </tr>
              <tr>
                <th><?php echo $form['name']->renderLabel() ?></th>
                <td>
                  <?php echo $form['name']->renderError() ?>
                  <?php echo $form['name'] ?>
                </td>
              </tr>
              
              <?php echo ExtraFieldsList::renderFormFiledsByType('discussions',$form->getObject(),$sf_user,'input') ?>
              
              <tr>
                <th><?php echo $form['description']->renderLabel() ?></th>
                <td>
                  <?php echo $form['description']->renderError() ?>
                  <?php echo $form['description'] ?>
                </td>
              </tr>
              <?php echo ExtraFieldsList::renderFormFiledsByType('discussions',$form->getObject(),$sf_user,'text') ?>
              <?php echo ExtraFieldsList::renderFormFiledsByType('discussions',$form->getObject(),$sf_user,'file') ?>
              
              <?php if(Users::hasAccess('edit','projects',$sf_user,$sf_request->getParameter('projects_id'))): ?>
              <tr>
                <th><?php echo $form['users_id']->renderLabel() ?></th>
                <td>
                  <?php echo $form['users_id']->renderError() ?>
                  <?php echo $form['users_id'] ?>
                </td>
              </tr>
              <?php endif ?>
            </table>
          </div>
                              
          <div>
            <?php include_component('attachments','attachments',array('bind_type'=>'discussions','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
          </div>
          
        </div>
      
        </td>
      </tr>      
    </tbody>
  </table>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'discussions')); ?>

<script type="text/javascript">    
  $(function() {           
    $( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) }); 
    $( "input.datepicker" ).each(function() { $(this).datepicker({ dateFormat: 'yy-mm-dd' }) });
    $( "input.datetimepicker" ).each(function() { $(this).datetimepicker({ dateFormat: 'yy-mm-dd' }) });
                
    $("ul.tabs").tabs("div.panes > div");
                                                                                             
  });
</script> 
