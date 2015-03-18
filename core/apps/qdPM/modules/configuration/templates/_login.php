<h1><?php echo __('Login Page Configuration') ?></h1>


<table class="contentTable">
  <tr>
    <th><label for="cfg_app_login_page_heading"><?php echo __('Heading'); ?></label></th>
    <td><?php echo input_tag('cfg[app_login_page_heading]', sfConfig::get('app_login_page_heading'),array('size'=>'40')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_login_page_content"><?php echo __('Content'); ?></label></th>
    <td><?php echo textarea_tag('cfg[app_login_page_content]', sfConfig::get('app_login_page_content'),array('class'=>'editor')); ?></td>
  </tr>
</table>

<script type="text/javascript">    
  $(function() {     
    //$( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) });               
  });
</script> 
