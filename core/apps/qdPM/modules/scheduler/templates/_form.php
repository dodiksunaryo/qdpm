<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if($form->getObject()->isNew()) $form->setDefault('start_date', date('Y-m-d',$sf_request->getParameter('day'))) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('end_date', date('Y-m-d',$sf_request->getParameter('day'))) ?>
<?php if($form->getObject()->isNew() and $sf_request->getParameter('users_id')>0) $form->setDefault('users_id', $sf_request->getParameter('users_id')) ?>
    
<form id="scheduler" action="<?php echo url_for('scheduler/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getEventId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table style="width:100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('users_id', $sf_request->getParameter('users_id')) ?>          
          <? echo submit_tag(__('Save') )?>
          &nbsp;&nbsp;<?php echo (!$form->getObject()->isNew() ? link_to(__('Delete'),'scheduler/delete?id=' . $form->getObject()->getEventId() . '&users_id=' . $form->getObject()->getUsersId(),array('confirm'=>__('Are you sure?'))):'')?>
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
              
              <tr>
                <th><?php echo $form['event_name']->renderLabel() ?></th>
                <td>
                  <?php echo $form['event_name']->renderError() ?>
                  <?php echo $form['event_name'] ?>
                </td>
              </tr>
              
              <?php echo ExtraFieldsList::renderFormFileds('events',$form->getObject(),$sf_user)?>
              
              <tr>
                <th><?php echo $form['start_date']->renderLabel() ?></th>
                <td>
                  <?php echo $form['start_date']->renderError() ?>
                  <?php echo $form['start_date'] ?>
                </td>
              </tr>
              <tr>
                <th><?php echo $form['end_date']->renderLabel() ?></th>
                <td>
                  <?php echo $form['end_date']->renderError() ?>
                  <?php echo $form['end_date'] ?>
                </td>
              </tr>
              <tr>
                <th><?php echo $form['details']->renderLabel() ?></th>
                <td>
                  <?php echo $form['details']->renderError() ?>
                  <?php echo $form['details'] ?>
                </td>
              </tr>
            </table>
          </div>
          
          
          <div>
            <?php include_component('attachments','attachments',array('bind_type'=>'events','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getEventId()))) ?>
          </div>
          
        </div>
      
        </td>
      </tr>
      

      
    </tbody>
  </table>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'scheduler')); ?>

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
