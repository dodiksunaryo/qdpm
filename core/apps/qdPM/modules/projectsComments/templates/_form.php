<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('created_by',$sf_user->getAttribute('id')) ?>

<form action="<?php echo url_for('projectsComments/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table style="width: 100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
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
         
      <?php if(Users::hasProjectsAccess('edit',$sf_user, $projects) and $form->getObject()->isNew()){ ?>
                 
          <?php if(app::countItemsByTable('ProjectsTypes')>0): ?>
          <tr>
            <th><?php echo __('Type') ?></th>
            <td>
              <?php echo select_tag('projects_types_id','',array('choices'=>app::getItemsChoicesByTable('ProjectsTypes',true))) ?>
            </td>
          </tr>
          <?php endif ?>
                    
    <?php  } ?>
                
          <?php if(app::countItemsByTable('ProjectsStatus')>0 and $form->getObject()->isNew()): ?>      
          <tr>
            <th><?php echo __('Status') ?></th>
            <td>              
              <?php echo select_tag('projects_status_id','',array('choices'=>app::getItemsChoicesByTable('ProjectsStatus',true))) ?>
            </td>
          </tr>
          <?php endif ?>
          <tr>
            <th><?php echo $form['description']->renderLabel() ?></th>
            <td>
              <?php echo $form['description']->renderError() ?>
              <?php echo $form['description'] ?>
            </td>
          </tr>
         </table>
        </div>
        
        <div>
          <?php include_component('attachments','attachments',array('bind_type'=>'projectsComments','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
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
    $("ul.tabs").tabs("div.panes > div");
     
  });
</script> 
