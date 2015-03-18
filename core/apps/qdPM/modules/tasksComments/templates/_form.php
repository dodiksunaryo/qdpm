<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('created_by',$sf_user->getAttribute('id')) ?>

<form action="<?php echo url_for('tasksComments/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" id="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
          <?php echo input_hidden_tag('tasks_id',$sf_request->getParameter('tasks_id')) ?>
          <input type="submit" value="<?php echo __('Save')?>" class="btn" />
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
          <td>
            <td>
             <table> 
              
              <?php if(app::countItemsByTable('TasksStatus')>0 and $form->getObject()->isNew()): ?>
              <tr>
                <th><?php echo $form['tasks_status_id']->renderLabel() ?></th>
                <td>
                  <?php echo $form['tasks_status_id']->renderError() ?>
                  <?php echo $form['tasks_status_id'] ?>
                </td>
              </tr>
              <?php endif ?>
              
              
        <?php if(Users::hasTasksAccess('edit',$sf_user,$tasks, $projects) and $form->getObject()->isNew()){ ?>
          
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
                <th><?php echo __('Label') ?></th>
                <td>
                  <?php echo select_tag('tasks_labels_id','',array('choices'=>app::getItemsChoicesByTable('TasksLabels',true))) ?>
                </td>
              </tr>
              <?php endif ?>
              
              <?php if(app::countItemsByTable('TasksTypes')>0): ?>
              <tr>
                <th><?php echo __('Type') ?></th>
                <td>
                  <?php echo select_tag('tasks_types_id','',array('choices'=>app::getItemsChoicesByTable('TasksTypes',true))) ?>
                </td>
              </tr>
              <?php endif ?>
              
              <tr>
                <th><?php echo $form['due_date']->renderLabel() ?></th>
                <td>
                  <?php echo $form['due_date']->renderError() ?>
                  <?php echo $form['due_date'] ?>
                </td>
              </tr> 
             
          <?php  } ?>
                           
              </table>
              </td>
              <td>
                <table>
                 <tr>
                    <th><?php echo $form['worked_hours']->renderLabel() ?></th>
                    <td>
                      <?php echo $form['worked_hours']->renderError() ?>
                      <?php echo $form['worked_hours'] ?>
                    </td>
                  </tr>
                  <tr>
                    <th><?php echo __('Progress') ?></th>
                    <td>
                      <?php echo select_tag('progress',$tasks->getProgress(),array('choices'=>Tasks::getProgressChoices())) ?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          
          <table>
          <tr>
            <th><?php echo $form['description']->renderLabel() ?></th>
            <td>
              <?php echo $form['description']->renderError() ?>
              <?php echo $form['description'] ?>
            </td>
          </tr>
          <?php if(sfConfig::get('app_allow_adit_tasks_comments_date')=='on'):?>
          <tr>
            <th><?php echo $form['created_at']->renderLabel() ?></th>
            <td>
              <?php echo $form['created_at']->renderError() ?>
              <?php echo $form['created_at'] ?>
            </td>
          </tr>
          <?php endif ?>
        </table>
        </div>
        
        <div>
          <?php include_component('attachments','attachments',array('bind_type'=>'comments','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
        </div>
       </div>
       
       </td>
      </tr>
    </tbody>
  </table>
</form>

<script type="text/javascript">    
  $(function() {      
    $( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) });
    $( "input.datepicker" ).each(function() { $(this).datepicker({ dateFormat: 'yy-mm-dd' }) });
    $( "input.datetimepicker" ).each(function() { $(this).datetimepicker({ dateFormat: 'yy-mm-dd' }) });
    
    $("ul.tabs").tabs("div.panes > div");
      
  });
</script> 
