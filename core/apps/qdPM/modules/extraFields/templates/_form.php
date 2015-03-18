<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $form->setDefault('bind_type',$sf_request->getParameter('bind_type')) ?>

<form id="extraFields" action="<?php echo url_for('extraFields/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table style="width:100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php echo input_hidden_tag('bind_type',$sf_request->getParameter('bind_type')) ?>
          <input type="submit" value="<?php echo __('Save') ?>" class="btn" />
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
        
        <div class="panes" >
          <div>
            <table>
            <tr>
              <th><?php echo $form['name']->renderLabel() ?></th>
              <td>
                <?php echo $form['name']->renderError() ?>
                <?php echo $form['name'] ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $form['type']->renderLabel() ?></th>
              <td>
                <?php echo $form['type']->renderError() ?>
                <?php echo $form['type'] ?>
                <div id="default_values_notes"></div>                
                <br>
              </td>
            </tr>
            <tr>
              <th><?php echo $form['sort_order']->renderLabel() ?></th>
              <td>
                <?php echo $form['sort_order']->renderError() ?>
                <?php echo $form['sort_order'] ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $form['display_in_list']->renderLabel() ?></th>
              <td>
                <?php echo $form['display_in_list']->renderError() ?>
                <?php echo $form['display_in_list'] ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $form['active']->renderLabel() ?></th>
              <td>
                <?php echo $form['active']->renderError() ?>
                <?php echo $form['active'] ?>
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

<?php
$n = array();
$n['text'] = __('Simple input text field.');
$n['number'] = __('This field used for numbers.');
$n['textarea'] = __('Simple textarea field.');
$n['textarea_wysiwyg'] = __('WYSIWYG editor will be automatically added to this field.');
$n['date_dropdown'] = __('Date with dropdown select');
$n['date_time_dropdown'] = __('Date - Time with dropdown select');
?>

<script type="text/javascript">


  function renderFieldNotes(ftype)
  {
    var n = new Array();
    
    <?php
      foreach($n as $k=>$v)
      {
        echo 'n["' . $k . '"]="' . addslashes($v) . '";' . "\n";
      }
    ?>
    
    if(n[ftype])
    {
      return n[ftype]; 
    }
    else
    {
      return '';
    }
  }
  

  $(function() {            
    $("ul.tabs").tabs("div.panes > div");
    
    $("#extra_fields_type").change(function() {         
        $("#default_values_notes").html(renderFieldNotes($(this).val()));                                          
    });
    
    type = $('#extra_fields_type').val();
    
    $("#default_values_notes").html(renderFieldNotes(type));
          
  });
</script>

<?php include_partial('global/formValidator',array('form_id'=>'extraFields')); ?>
