<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if($form->getObject()->isNew())$form->setDefault('created_by',$sf_user->getAttribute('id')) ?>

<form id="projects" action="<?php echo url_for('projects/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table style="width: 100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>          
          <?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>
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
      	<li><a href="#"><?php echo __('Team') ?></a></li>      	
      	<li><a href="#"><?php echo __('Attachments') ?></a></li>
      </ul>
      
      <div class="panes">
        <div>
           <table>          
          <?php if(app::countItemsByTable('ProjectsTypes')>0): ?>
          <tr>
            <th><?php echo $form['projects_types_id']->renderLabel() ?></th>
            <td>
              <?php echo $form['projects_types_id']->renderError() ?>
              <?php echo $form['projects_types_id'] ?>
            </td>
          </tr>
          <?php endif ?>
                
          <?php if(app::countItemsByTable('ProjectsStatus')>0): ?>      
          <tr>
            <th><?php echo $form['projects_status_id']->renderLabel() ?></th>
            <td>
              <?php echo $form['projects_status_id']->renderError() ?>
              <?php echo $form['projects_status_id'] ?>
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
                      
          <?php echo ExtraFieldsList::renderFormFiledsByType('projects',$form->getObject(),$sf_user,'input')?>
                
          <tr>
            <th><?php echo $form['description']->renderLabel() ?></th>
            <td>
              <?php echo $form['description']->renderError() ?>
              <?php echo $form['description'] ?>
            </td>
          </tr>
          
          <?php echo ExtraFieldsList::renderFormFiledsByType('projects',$form->getObject(),$sf_user,'text')?>          
          <?php echo ExtraFieldsList::renderFormFiledsByType('projects',$form->getObject(),$sf_user,'file')?>
          
          </table>
        </div>                
        
        <div>
          <?php include_component('projects','team',array('project'=>$form->getObject())) ?>
        </div>
                                      
        <div>
          <?php include_component('attachments','attachments',array('bind_type'=>'projects','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
        </div>
                
      </div>
      
        </td>
       </tr>
    </tbody>
  </table>
</form>

<?php include_partial('global/formValidatorExt',array('form_id'=>'projects')); ?>

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
                                                                                                                                                       
    
    $('.check_all_users').bind('click', function() { 
       rnd = $(this).attr('id').replace('check_all_users_','');
       checked = $(this).attr('checked');
       
       $( ".rnd"+rnd ).each(function() {
          if(checked)
          {
            $(this).attr('checked',true)
          }
          else
          {
            $(this).attr('checked',false)
          }
          
          updateUserRoles($(this));
       });
    });
                                                              
  });
</script> 


