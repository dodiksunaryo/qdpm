<div id="appNameContainer">
  <div id="appNameBox"> 
    <?php 
    if(is_file(sfConfig::get('sf_upload_dir')  . '/' . sfConfig::get('app_app_logo')))
    {
      echo link_to(image_tag('/uploads/' . sfConfig::get('app_app_logo'), array('title'=>sfConfig::get('app_app_name'))),'dashboard/index');
    }
    else
    {
      echo sfConfig::get('app_app_name');
    }
     
    
    ?>
  </div>
</div>
