<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if($form->getObject()->isNew()) $form->setDefault('users_id',$sf_user->getAttribute('id')) ?>

<form action="<?php echo url_for('discussionsComments/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>
          <?php echo input_hidden_tag('discussions_id',$sf_request->getParameter('discussions_id')) ?>
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

         <?php if(app::countItemsByTable('DiscussionsStatus')>0 and $form->getObject()->isNew()): ?>
          <tr>
            <th><?php echo $form['discussions_status_id']->renderLabel() ?></th>
            <td>
              <?php echo $form['discussions_status_id']->renderError() ?>
              <?php echo $form['discussions_status_id'] ?>
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
          <?php include_component('attachments','attachments',array('bind_type'=>'discussionsComments','bind_id'=>($form->getObject()->isNew()?0:$form->getObject()->getId()))) ?>
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
