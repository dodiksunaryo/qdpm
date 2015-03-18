<?php

$html = '';

$related_attachments = array();
foreach ($attachments as $v)
{
 $file_path = sfConfig::get('sf_upload_dir') . '/attachments/' . $v['file'];
  
 if(is_file($file_path))
 {
   if(getimagesize($file_path))
   {
     $html .= '<li>' . Attachments::getFileIcon($v['file'])  . ' ' . link_to( substr($v['file'],7), 'attachments/view?id=' . $v['id'], array('target'=>'_blank', 'absolute'=>true)) . '&nbsp;&nbsp;' .  link_to(image_tag(public_path('images/icons/zoom.png', true),array('border'=>0)) . '&nbsp;' .  __('view'), 'attachments/view?id=' . $v['id'], array('target'=>'_blank', 'style'=>'text-decoration:none', 'absolute'=>true))  . '&nbsp;&nbsp;'  . link_to(image_tag(public_path('images/icons/download.png', true),array('border'=>0)) . '&nbsp;'.   __('download'), 'attachments/download?id=' . $v['id'], array('style'=>'text-decoration:none','absolute'=>true)) . '&nbsp;&nbsp;' . $v['info'] . '</li>'  . "\n";
   }
   else
   {
     $html .= '<li>' . Attachments::getFileIcon($v['file'])  . ' ' . link_to( substr($v['file'],7), 'attachments/download?id=' . $v['id'], array('absolute'=>true))  . '&nbsp;&nbsp;'  . link_to(image_tag(public_path('images/icons/download.png', true),array('border'=>0)) . '&nbsp;'.   __('download'), 'attachments/download?id=' . $v['id'], array('style'=>'text-decoration:none','absolute'=>true)) . '&nbsp;&nbsp;' . $v['info'] . '</li>'  . "\n";
   } 
   
   $related_attachments[] = $v['id'];
 }
}

?>
<?php if(strlen($html)>0):?>
  <br><?php echo __('Attachments') ?>:
  <ul class="attachedList" id="attachedList">
    <?php echo $html; ?>
  </ul>
  <?php echo input_hidden_tag('item_attachments',implode(',',$related_attachments)) ?>
<?php endif ?>


