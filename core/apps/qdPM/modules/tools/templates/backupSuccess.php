<h1><?php echo __('Backup') ?></h1>

<?php echo '<table><tr><td>' . button_to(__('Backup'),'tools/doBackup',array('confirm'=>__('Are you sure?'),'class'=>'btn')) . '</td><td style="padding-left: 15px;">' . ((count($backups)>sfConfig::get('app_rows_per_page'))? get_partial('global/jsPager', array('id'=>'pager')): '') . '</td></tr></table>' ?>

<table class="tableListing"  id="tableListing" style="display:none;">
  <thead>
    <tr>      
      <th width="100%"><?php echo __('File') ?></th>      
      <th><?php echo __('Size') ?></th>
      <th><?php echo __('Date') ?></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php foreach($backups as $file): ?>
    <tr>          
      <td><?php echo $file; ?></td>
      <td><?php echo number_format(filesize(sfConfig::get('sf_web_dir') . '/backups/' . $file))  . ' ' . __('bytes'); ?></td>
      <td><?php echo app::dateTimeFormat('',filemtime(sfConfig::get('sf_web_dir') . '/backups/' . $file)); ?></td>
      
      <td><?php echo button_to(__('Restore'),'tools/doRestore?restore_file=' . $file,array('confirm'=>__('Are you sure?'),'class'=>'btn'))?></td>
      <td><?php echo button_to(__('Download'),'tools/backup?download_file=' . $file,array('class'=>'btn'))?></td>
      <td><?php echo button_to(__('Delete'),'tools/backup?delete_file=' . $file,array('confirm'=>__('Are you sure?'),'class'=>'btn'))?></td>
    </tr>
<?php endforeach ?> 
<?php if(count($backups)==0) echo '<tr><td colspan="20">' . __('No Records Found') . '</td></tr>';?>  
   <tbody> 
</table> 

<?php echo __('Backup Directory') . ': ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/backups/' ?><br> 

<?php echo button_to(__('Backup'),'tools/doBackup',array('confirm'=>__('Are you sure?'),'class'=>'btn')); ?> 

<script type="text/javascript">
  $(document).ready(function(){   
    $("#tableListing").css('display','table');    
    $("#tableListing").tablesorter({ widgets: ['zebra']}).tablesorterPager({ container: $("#pager"),size:<?php echo sfConfig::get('app_rows_per_page')?>, positionFixed: false});
                                      
  });     
</script>