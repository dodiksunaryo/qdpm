<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_title() ?>
    
    <?php echo stylesheet_tag('/js/yui2.9.0/build/menu/css/menu.css') ?>
    
    <?php echo javascript_include_tag('yui2.9.0/build/yahoo-dom-event/yahoo-dom-event.js') ?>
    <?php echo javascript_include_tag('yui2.9.0/build/container/container-min.js') ?>
    <?php echo javascript_include_tag('yui2.9.0/build/menu/menu-min.js') ?>
    
    <?php echo javascript_include_tag('jquery-1.7.min.js') ?>
    <?php echo javascript_include_tag('jquery.validate.1.9.0.min.js') ?>
    <?php echo javascript_include_tag('jquery.modalbox-1.2.0.js') ?>    
    <?php echo javascript_include_tag('jquery-ui-1.8.12.custom.min.js') ?>
    <?php echo javascript_include_tag('jquery-ui-timepicker-addon.js') ?>
    <?php echo javascript_include_tag('jquery.tools.min.js') ?>
    
    <?php     
      if(($culture = $sf_user->getCulture())!='en')
      {                        
        if(strstr($culture,'_'))
        {
          $culture = substr($culture,0,2);
        }
                                
        if(is_file('js/ui/i18n/jquery.ui.datepicker-' . $culture . '.js'))
        {
          echo javascript_include_tag('ui/i18n/jquery.ui.datepicker-' . $culture . '.js');
        }
      } 
    ?>
        
    <?php echo javascript_include_tag('cluetip1.2.5/lib/themeswitchertool.js') ?>
    <?php echo javascript_include_tag('cluetip1.2.5/lib/jquery.hoverIntent.js') ?>
    <?php echo javascript_include_tag('cluetip1.2.5/lib/jquery.bgiframe.min.js') ?>
    <?php echo javascript_include_tag('cluetip1.2.5/jquery.cluetip.min.js') ?>
    <?php echo stylesheet_tag('/js/cluetip1.2.5/jquery.cluetip.css') ?>
    
    <?php echo javascript_include_tag('tablesorter/tablesorter.js') ?>
    <?php echo javascript_include_tag('tablesorter/tablesorter_filter.js') ?>    
    <?php echo javascript_include_tag('tablesorter/jquery.tablesorter.pager.js') ?>
    <?php echo javascript_include_tag('tablesorter/jquery.metadata.js') ?>
    
    <?php echo javascript_include_tag('jquery.ui.nestedSortable.js') ?>
    <?php echo javascript_include_tag('jquery.hoverIntent.minified.js') ?>
    <?php echo javascript_include_tag('jquery.timers.js') ?>
                
    <?php echo stylesheet_tag('ui-lightness/jquery-ui-1.8.12.custom.css') ?>
    
    <?php echo javascript_include_tag('uploadify/jquery.uploadify-3.1.min.js') ?>
    <?php echo stylesheet_tag('/js/uploadify/uploadify.css') ?>
    
    <?php echo stylesheet_tag('common.css') ?>
    
    <?php echo (is_file('css/skins/' . $sf_request->getCookie ('skin', sfConfig::get('app_default_skin','Default')) . '/styles.css') ? stylesheet_tag('skins/' . $sf_request->getCookie ('skin', sfConfig::get('app_default_skin','Default')) . '/styles.css') : stylesheet_tag('skins/Default/styles.css')) ?>
    
    
    <script type="text/javascript">
      var sf_public_path = '<?php echo public_path("/") ?>';
      var selected_items = new Array();
      var CKEDITOR = false;
      var CKEDITOR_holders = new Array();

      function keep_session()
      {
        $.ajax({url: '<?php echo url_for("login/keepSession") ?>'});
      }

      $(function(){
        setInterval("keep_session()",600000);        
      });
            
    </script>
        
    <?php echo javascript_include_tag('nicEdit/nicEdit.js') ?>    
    <?php echo javascript_include_tag('helpers/app.js') ?>   
    <?php echo javascript_include_tag('helpers/jquery.htmlClean.min.js') ?>

    <?php if(is_file('js/texteditor/ckeditor.js')) echo javascript_include_tag('texteditor/ckeditor.js') ?>
    
    <?php echo javascript_include_tag('detectmobilebrowser.js') ?>        
    
    <?php echo t::renderJsDictionary() ?>

    <link rel="shortcut icon" href="<?php echo public_path('favicon.ico') ?>" />
    <link rel="apple-touch-icon" href="<?php echo public_path('favicon.png') ?>" />
  </head>
  <body class="yui-skin-sam" id="yahoo-com">
    
    <div id="pageContainer">
      <div id="page">

        <div id="headerContainer">
          <div id="headerBox">
            <?php include_partial('global/userMenu'); ?>
            <?php include_partial('global/appName'); ?>
            <?php include_partial('global/menu'); ?>
          </div>
        </div>

        <div id="contentContainer">
          <div id="content">
            <?php if($sf_user->hasFlash('userNotices')) include_partial('global/userNotices', array('userNotices' => $sf_user->getFlash('userNotices'))); ?>
            <?php if(is_dir(sfConfig::get('sf_web_dir') . '/install')) include_partial('global/userNotices', array('userNotices' => array('text'=>__('Please remove \'install\' folder'),'type'=>'warning'))); ?>
            <?php echo $sf_content ?>
          </div>
        </div>

      </div>

    </div>
    <?php include_partial('global/footer'); ?>        
  </body>
</html>
