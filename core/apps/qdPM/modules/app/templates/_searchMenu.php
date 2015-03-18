<?php

  $search = $sf_request->getParameter('search');
  
  $hmtl = '
    <form action="' . url_for($sf_context->getModuleName().'/index' . ($sf_request->hasParameter('projects_id') ? '?projects_id=' . $sf_request->getParameter('projects_id'):'')) . '" method="post">
    <table style="margin: 5px 0;" class="contentTable">
      <tr>
        <td valign="top">' . __('Search') . '</td>
        <td>' . input_tag('search[keywords]',(isset($search['keywords']) ? $search['keywords']:''),array('size'=>'30')). '</td>
        <td valign="top"><input type="submit" class="btn"  value="' . __('Search') . '"></td>
      </tr>
      <tr>
        <td>' . __('Search In') . ':</td>
        <td>
        <input name="search[in_description]" ' . (isset($search['in_description']) ? 'checked="checked"':'') .  ' type="checkbox" id="search_in_description"> <label for="search_in_description">' . __('Description') . '</label></br>
        <input name="search[in_comments]" ' . (isset($search['in_comments']) ? 'checked="checked"':'') .  ' type="checkbox" id="search_in_comments"> <label for="search_in_comments">' . __('Comments') . '</label><br>
        ' . get_component('app','extraFieldsInSearch',array('type'=>$sf_context->getModuleName())) . '
        </td>
        
      </tr>  
    </table>
    </form>
  ';

  $s = array();  
  $s[] = array('title'=>$hmtl);

  $m = array();
  $m[] = array('title'=>__('Search'),'submenu'=>$s);
    
?>

<div id="searchMenuBox"> 
<table>
  <tr>
    <td><?php echo renderYuiMenu('search_menu', $m) ?></td>
    <td  style="font-size:11px; color: gray;"><?php echo (isset($search['keywords']) ? __('Search result for') . ' <b>"' . $search['keywords'] . '"</b>&nbsp;&nbsp;&nbsp;<a href="' . url_for($sf_context->getModuleName().'/index'. ($sf_request->hasParameter('projects_id') ? '?projects_id=' . $sf_request->getParameter('projects_id'):'')) . '">' . __('Reset') . '</a>':'') ?></td>
  </tr>
</table>
</div>
    
<script type="text/javascript">
    YAHOO.util.Event.onContentReady("search_menu", function () 
    {
        var oMenuBar = new YAHOO.widget.MenuBar("search_menu", {
                                                autosubmenudisplay: true,
                                                hidedelay: 4000,
                                                submenuhidedelay: 0,
                                                showdelay: 150,
                                                keepopen: true,                                                
                                                lazyload: true });
        oMenuBar.render();
    });
</script>