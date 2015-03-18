<h1><?php echo __('My Account') ?></h1>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form  id="users" action="<?php echo url_for('myAccount/update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="contentTable">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <br>          
          <input type="button" class="btn" value="<?php echo __('Save')?>" id="submit_button" onClick="check_user_form('users','<?php echo url_for('myAccount/checkUser') ?>')"/>                   
         <div id="loading" ></div>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td>
        
      <?php echo $form->renderGlobalErrors() ?>
      
      <ul class="tabs">
      	<li><a href="#"><?php echo __('General') ?></a></li>              	
      </ul>
      
      <div class="panes">
        <div>
           <table>
              <tr>
                <th><?php echo __('Group') ?></th>
                <td>          
                  <?php $user = $sf_user->getAttribute('user'); echo $user->getUsersGroups()->getName(); ?>
                </td>
              </tr>            
              <tr>
                <th><?php echo $form['name']->renderLabel() ?></th>
                <td>
                  <?php echo $form['name']->renderError() ?>
                  <?php echo $form['name'] ?>
                </td>
              </tr>    
              <tr>
                <th><?php echo $form['new_password']->renderLabel() ?></th>
                <td>
                  <?php echo $form['new_password']->renderError() ?>
                  <?php echo $form['new_password'] ?>
                </td>
              </tr>                  
              <tr>
                <th><?php echo $form['email']->renderLabel() ?></th>
                <td>
                  <?php echo $form['email']->renderError() ?>
                  <?php echo $form['email'] ?>
                  <div id="email_error" class="error"></div>
                </td>
              </tr>
              
              <?php echo ExtraFieldsList::renderFormFileds('users',$form->getObject(),$sf_user)?>
              
              <tr><th><br></th></tr>
              <tr>
                <th><?php echo $form['photo']->renderLabel() ?></th>
                <td>
                  <?php echo $form['photo']->renderError() ?>
                  <?php echo $form['photo'] ?>
                  <div><?php if(strlen($form['photo']->getValue())>0) echo renderUserPhoto($form['photo']->getValue())  . '<br>'. $form['remove_photo'] . ' ' . $form['remove_photo']->renderLabel() ?></div>
                </td>
              </tr>
              <tr>
                <th><?php echo $form['culture']->renderLabel() ?></th>
                <td>
                  <?php echo $form['culture']->renderError() ?>
                  <?php echo $form['culture'] ?>
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

<?php include_partial('global/formValidator',array('form_id'=>'users')); ?>

<script type="text/javascript">    
  $(function() {     
    $( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) }); 
    $( "input.datepicker" ).each(function() { $(this).datepicker({ dateFormat: 'yy-mm-dd' }) });
    $( "input.datetimepicker" ).each(function() { $(this).datetimepicker({ dateFormat: 'yy-mm-dd' }) });
    
    $("ul.tabs").tabs("div.panes > div");    
            
    
    $("#submit_button").click(function() {
        $("#users").valid()                              
    });
              
  });
</script> 
