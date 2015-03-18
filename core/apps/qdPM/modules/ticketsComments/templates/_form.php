<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php $tickets = Doctrine_Core::getTable('Tickets')->find($sf_request->getParameter('tickets_id')); ?>
<?php if($form->getObject()->isNew()) $form->setDefault('users_id',$sf_user->getAttribute('id')) ?>

<form id="ticketsComments" action="<?php echo url_for('ticketsComments/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
          <?php echo input_hidden_tag('tickets_id',$sf_request->getParameter('tickets_id')) ?>
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
              
              <?php if(app::countItemsByTable('TicketsStatus')>0  and $form->getObject()->isNew()): ?>
              <tr>
                <th><?php echo $form['tickets_status_id']->renderLabel() ?></th>
                <td>
                  <?php echo $form['tickets_status_id']->renderError() ?>
                  <?php echo $form['tickets_status_id'] ?>
                </td>
              </tr>
              <?php endif ?>
           
           
        <?php if(Users::hasTicketsAccess('edit',$sf_user,$tickets, $projects)  and $form->getObject()->isNew()){ ?>                          
              
              <?php if(app::countItemsByTable('TicketsTypes')>0): ?>
              <tr>
                <th><?php echo __('Type') ?></th>
                <td>                  
                  <?php echo select_tag('tickets_types_id','',array('choices'=>app::getItemsChoicesByTable('TicketsTypes',true))) ?>
                </td>
              </tr>
              <?php endif ?>
              
              <?php if($sf_request->getParameter('projects_id')>0): ?>
              <tr>
                <th><?php echo __('Departments')?></th>
                <td>                  
                  <?php echo select_tag('departments_id','',array('choices'=>app::getItemsChoicesByTable('Departments',true))) ?>
                </td>
              </tr>
              <?php endif ?>
              
        <?php  } ?>      
        
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
          <?php include_component('attachments','attachments',array('bind_type'=>'ticketsComments','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
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
