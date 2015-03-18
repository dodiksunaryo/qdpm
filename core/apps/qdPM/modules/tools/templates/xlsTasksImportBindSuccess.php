<h1><?php echo __('Import Spreadsheet (Step 2)')?></h1>

<div><?php echo __('Bind Task fields with spreadsheet columns below and start import.')?><br><?php echo __('Column without binded field will be not imported.')?></div><br>

<form id="import" action="<?php echo url_for('tools/xlsTasksImport')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sf_method" value="put" />
<?php echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) . input_hidden_tag('import_file',$import_file);?>

  <table class="contentTable">

  </table>
  
<table class="import_spreadsheet_table">
<?php
  echo '<tr>';
  for($j=1;$j<=$data->colcount();$j++)
  {
    echo '<th><a style="font-weight: bold;" href="javascript: openModalBox(\'' . url_for('tools/xlsTasksImportBindField?col=' . $j) . '\')">' . __('Bind Field') . '</a><div id="column_' . $j . '">-</div></ht>';
  }
  echo '</tr>';

  for($i=1;$i<=$data->rowcount();$i++)
  {
    echo '<tr>';
    for($j=1;$j<=$data->colcount();$j++)
    {
      echo '<td>' . strip_tags($data->val($i,$j)) . '</td>';
    }
    echo '</tr>'; 
    
    if($i==5)
    {
      break;
    } 
    
  }
?>
</table>  
<br>
  
  <input id="import_first_row" name="import_first_row" type="checkbox" value="1"> <label for="import_first_row"><?php echo __('Import first row') ?></label><br>
<br>  
  <?php echo submit_tag(__('Import')) ?>
</form>

<script>
  function bindField(col)
  {
    var field_name = '-';
    $.post("<?php echo url_for('tools/xlsTasksImportBindField') ?>", $("#bind_filed").serialize()).success(function(data) { 
      if(data!='-')
      {
        $('#column_'+col).html('<div class="background_color_item" style="background: #56C71E; color: white;">'+data+'</div>');
      }
      else
      {
        $('#column_'+col).html('-');
      }      
      jQuery.fn.modalBox("close"); 
    });     
  }
</script