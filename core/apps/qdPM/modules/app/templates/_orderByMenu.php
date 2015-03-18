
<div id="orderByMenuBox">
<table>
  <tr>
    <td><?php echo renderYuiMenu('order_by_menu', $m) ?></td>
    <td style="font-size:11px; color: gray;"><?php echo app::getListingOrderTitle($module,$sf_user,$sf_request->getParameter('projects_id')) ?></td>
  </tr>
</table>
</div>  

    
<script type="text/javascript">
    YAHOO.util.Event.onContentReady("order_by_menu", function () 
    {
        var oMenuBar = new YAHOO.widget.MenuBar("order_by_menu", {
                                                autosubmenudisplay: true,
                                                hidedelay: 750,
                                                submenuhidedelay: 0,
                                                showdelay: 150,                                                                                                
                                                lazyload: true });
        oMenuBar.render();
    });
</script>