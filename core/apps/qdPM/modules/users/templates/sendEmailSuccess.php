<h1><?php echo __('Send email to users')?></h1>
<br>
<form id="send" action="<?php echo url_for('users/sendEmail') ?>" method="post">
<input type="hidden" name="sf_method" value="put" />
<table  class="contentTable">
  <tr>
    <td><?php echo __('From') ?></td>
    <td><?php echo $user->getName() . ' &lt;' . $user->getEmail(). '&gt;' ?></td>
  </tr>
  <tr>
    <td><?php echo __('To') ?><br><a href="#" onClick="return checkAllInContainer('users_groups_container')"><small><?php echo __('Select All')?></small></a></td>
    <td><div id="users_groups_container"><?php echo select_tag('users_groups','',array('choices'=>UsersGroups::getChoicesByType(),'multiple'=>true,'expanded'=>true)) ?></div></td>
  </tr>
  <tr>
    <td><?php echo __('Subject') ?></td>
    <td><?php echo input_tag('subject',$sf_request->getParameter('subject'),array('size'=>60,'class'=>'required')) ?></td>
  </tr>
  <tr>
    <td><?php echo __('Message') ?></td>
    <td><?php echo textarea_tag('message',$sf_request->getParameter('message'),array('class'=>'editor')) ?></td>
  </tr>
</table>
<br>
<?php echo submit_tag(__('Send Message')) ?>
<form>

<?php include_partial('global/formValidator',array('form_id'=>'send')); ?>

<script type="text/javascript">    
  $(function() {  
         
    $( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) }); 
                
    $('.nicEdit-main').bind('keyup', function() {     
       $( ".nicEdit-main" ).each(function() {       
         id = $(this).attr('id');
         tid = id.replace('_nicEditor','');
         $('#'+tid).val($('#'+id).html());                
       });        
    }); 
    
        
                                                                
  });
</script> 