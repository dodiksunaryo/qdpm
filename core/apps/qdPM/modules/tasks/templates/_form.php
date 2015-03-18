<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('projects_id',$sf_request->getParameter('projects_id')) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('created_by',$sf_user->getAttribute('id')) ?>
<?php if(!$form->getObject()->isNew()) $form->setDefault('assigned_to',explode(',',$form['assigned_to']->getValue())) ?>

<form id="tasks" action="<?php echo url_for('tasks/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php include_component('app','copyToRelated',array('form_name'=>'tasks')) ?>

  <table style="width: 100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
          <?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>
          <?php echo input_hidden_tag('related_tickets_id',$sf_request->getParameter('related_tickets_id')) ?>
          <?php echo input_hidden_tag('related_discussions_id',$sf_request->getParameter('related_discussions_id')) ?>                    
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
        	<li><a href="#"><?php echo __('Time') ?></a></li>
        	<li><a href="#"><?php echo __('Attachments') ?></a></li>
        </ul>
        
        <div class="panes">
          <div>         
            <table>
            
            <?php if(app::countItemsByTable('TasksTypes')>0): ?>
            <tr>
              <th><?php echo $form['tasks_type_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['tasks_type_id']->renderError() ?>
                <?php echo $form['tasks_type_id'] ?>
              </td>
            </tr>
            <?php endif ?>
            
            
            
            <tr>
              <th><?php echo $form['name']->renderLabel() ?></th>
              <td>
                <?php echo $form['name']->renderError() ?>
                <?php echo $form['name'] ?>
              </td>
            </tr>
            
            <?php if(app::countItemsByTable('TasksStatus')>0): ?>
            <tr>
              <th><?php echo $form['tasks_status_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['tasks_status_id']->renderError() ?>
                <?php echo $form['tasks_status_id'] ?>
              </td>
            </tr>
            <?php endif ?>
            
            <?php if(app::countItemsByTable('TasksPriority')>0): ?>
            <tr>
              <th><?php echo $form['tasks_priority_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['tasks_priority_id']->renderError() ?>
                <?php echo $form['tasks_priority_id'] ?>
              </td>
            </tr>
            <?php endif ?>
            
            <?php if(app::countItemsByTable('TasksLabels')>0): ?>
            <tr>
              <th><?php echo $form['tasks_label_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['tasks_label_id']->renderError() ?>
                <?php echo $form['tasks_label_id'] ?>
              </td>
            </tr>
            <?php endif ?>
            
            <?php if(app::countItemsByTable('TasksGroups',$sf_request->getParameter('projects_id'))>0): ?>
            <tr>
              <th><?php echo $form['tasks_groups_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['tasks_groups_id']->renderError() ?>
                <?php echo $form['tasks_groups_id'] ?>
              </td>
            </tr>
            <?php endif ?>
            
            <?php if(app::countItemsByTable('ProjectsPhases',$sf_request->getParameter('projects_id'))>0): ?>
            <tr>
              <th><?php echo $form['projects_phases_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['projects_phases_id']->renderError() ?>
                <?php echo $form['projects_phases_id'] ?>
              </td>
            </tr>
            <?php endif ?>
            
            <?php if(app::countItemsByTable('Versions',$sf_request->getParameter('projects_id'))>0): ?>
            <tr>
              <th><?php echo $form['versions_id']->renderLabel() ?></th>
              <td>
                <?php echo $form['versions_id']->renderError() ?>
                <?php echo $form['versions_id'] ?>
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
            
            <?php echo ExtraFieldsList::renderFormFiledsByType('tasks',$form->getObject(),$sf_user,'input')?>
            
            <tr>
              <th><?php echo $form['description']->renderLabel() ?></th>
              <td>
                <?php echo $form['description']->renderError() ?>
                <?php echo $form['description'] ?>
              </td>
            </tr>
            
            <?php echo ExtraFieldsList::renderFormFiledsByType('tasks',$form->getObject(),$sf_user,'text')?>
            <?php echo ExtraFieldsList::renderFormFiledsByType('tasks',$form->getObject(),$sf_user,'file')?>
            
            
            <?php if(Users::hasAccess('edit','projects',$sf_user,$sf_request->getParameter('projects_id'))): ?>
            <tr>
              <th><?php echo $form['created_by']->renderLabel() ?></th>
              <td>
                <?php echo $form['created_by']->renderError() ?>
                <?php echo $form['created_by'] ?>
              </td>
            </tr>                        
            <?php endif ?>
            </table>            
          </div>
          
          
            
          <div>
            <table>
            <tr>
              <th><?php echo $form['estimated_time']->renderLabel() ?></th>
              <td>
                <?php echo $form['estimated_time']->renderError() ?>
                <?php echo $form['estimated_time'] ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $form['start_date']->renderLabel() ?></th>
              <td>
                <?php echo $form['start_date']->renderError() ?>
                <?php echo $form['start_date'] ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $form['due_date']->renderLabel() ?></th>
              <td>
                <?php echo $form['due_date']->renderError() ?>
                <?php echo $form['due_date'] ?>
              </td>
            </tr>            
            <tr>
              <th><?php echo $form['progress']->renderLabel() ?></th>
              <td>
                <?php echo $form['progress']->renderError() ?>
                <?php echo $form['progress'] ?>
              </td>
            </tr>
            </table>
          </div>
          
          <div>
            <?php include_component('attachments','attachments',array('bind_type'=>'tasks','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
          </div>
          
        </div>
      
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'tasks')); ?>

<script type="text/javascript">    
  $(function() {  
         
    $( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) }); 
    $( "input.datepicker" ).each(function() { $(this).datepicker({ dateFormat: 'yy-mm-dd' }) });
    $( "input.datetimepicker" ).each(function() { $(this).datetimepicker({ dateFormat: 'yy-mm-dd' }) });    
            
    $("ul.tabs").tabs("div.panes > div");
            
    $('.nicEdit-main').bind('keyup', function() {     
       $( ".nicEdit-main" ).each(function() {       
         id = $(this).attr('id');
         tid = id.replace('_nicEditor','');
         $('#'+tid).val($('#'+id).html());                
       });        
    });             
                                                                
  });
</script> 
