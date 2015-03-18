<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('users_id',$sf_user->getAttribute('id')) ?>

<form id="ticketsReports" action="<?php echo url_for('ticketsReports/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="contentTable">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?> 
          <?php echo input_hidden_tag('redirect_to',$sf_request->getParameter('redirect_to')) ?>         
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
        <th><?php echo $form['display_on_home']->renderLabel() ?></th>
        <td>
          <?php echo $form['display_on_home']->renderError() ?>
          <?php echo $form['display_on_home'] ?>
        </td>
      </tr>      
    </table>
    
    
    <ul class="tabs">
        	<li><a href="#"><?php echo __('Tickets Filters') ?></a></li>                  	
        	<li><a href="#"><?php echo __('Projects Filters') ?></a></li>
        </ul>
        
        <div class="panes">
          <div>
            <table> 
            <tr>
              <td>          
                <table>
                  <tr>      
                    <?php echo app::getReportFormFilterByTable('Department','tickets_reports[departments_id]','Departments',$form['departments_id']->getValue()) ?>                    
                    <?php echo app::getReportFormFilterByTable('Status','tickets_reports[tickets_status_id]','TicketsStatus',$form['tickets_status_id']->getValue()) ?>
                    <?php echo app::getReportFormFilterByTable('Type','tickets_reports[tickets_types_id]','TicketsTypes',$form['tickets_types_id']->getValue()) ?>                            
                  </tr>  
                </table>

              </td>

              </tr>
            </table>  
              
          </div>
                                                
          <div>     
            <table> 
            <tr>
              <td>
                <table>
                  <tr>      
                    
                    <?php echo app::getReportFormFilterByTable('Status','tickets_reports[projects_status_id]','ProjectsStatus',$form['projects_status_id']->getValue()) ?>
                    <?php echo app::getReportFormFilterByTable('Type','tickets_reports[projects_type_id]','ProjectsTypes',$form['projects_type_id']->getValue()) ?>
                            
                  </tr>  
                </table>                                                
              </td>
              <?php              
                if(count($choices = app::getProjectChoicesByUser($sf_user,true,'tickets'))>0)
                { 
                  if(!is_string($v = $form['projects_id']->getValue())) $v = '';
                  echo '<td style="padding-right: 10px;"><b>' . __('Projects') . '</b><br>' . select_tag('tickets_reports[projects_id]',explode(',',$v),array('choices'=>$choices,'multiple'=>true),array('style'=>'height: 400px; width: 250px;')) . '</td>';
                }                        
              ?>      
            </tr>
            </table>
          </div>
        </div>
   <br>             
  <input type="submit" value="<?php echo __('Save') ?>" class="btn" />
</form>

<?php include_partial('global/formValidator',array('form_id'=>'ticketsReports')); ?>

<script type="text/javascript">    
  $(function() {  
    $("ul.tabs").tabs("div.panes > div");                                                                      
  });
</script> 
