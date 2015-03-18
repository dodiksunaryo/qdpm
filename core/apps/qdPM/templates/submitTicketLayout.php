<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_title() ?>
    
    <?php echo javascript_include_tag('jquery-1.7.min.js') ?>
    <?php echo javascript_include_tag('jquery.validate.1.9.0.min.js') ?>
    <?php echo javascript_include_tag('jquery-ui-1.8.12.custom.min.js') ?>
    <?php echo javascript_include_tag('jquery-ui-timepicker-addon.js') ?>
    <?php echo javascript_include_tag('jquery.tools.min.js') ?>

    <?php echo stylesheet_tag('common.css') ?>
    
    <?php echo stylesheet_tag('submitTicket/styles.css') ?>
    
    
    <?php echo javascript_include_tag('helpers/app.js') ?>

    <link rel="shortcut icon" href="<?php echo public_path('favicon.ico') ?>" />
  </head>
  <body class="yui-skin-sam" id="yahoo-com">
    
    <div id="pageContainer">
      <div id="page">
        <div id="contentContainer">
          <div id="content">
            <?php if($sf_user->hasFlash('userNotices')) include_partial('global/userNotices', array('userNotices' => $sf_user->getFlash('userNotices'))); ?>
            <?php if(is_dir(sfConfig::get('sf_web_dir') . '/install')) include_partial('global/userNotices', array('userNotices' => array('text'=>'Please remove \'install\' folder','type'=>'warning'))); ?>
            <?php echo $sf_content ?>
          </div>
        </div>
      </div>
      
    </div>
  </body>
</html>
