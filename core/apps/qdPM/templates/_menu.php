<div class="menuContainer">
  <div id="menuBox">

<?php $m = new menuController($sf_user,$sf_request); echo renderYuiMenu('menu', $m->buildMenu()) ?>
  
<script type="text/javascript">
    YAHOO.util.Event.onContentReady("menu", function () 
    {
        var oMenuBar = new YAHOO.widget.MenuBar("menu", {
                                                autosubmenudisplay: true,
                                                hidedelay: 750,
                                                submenuhidedelay: 0,
                                                scrollincrement:10,
                                                showdelay: 150,
                                                lazyload: true });
        oMenuBar.render();
    });
</script>

  </div>
</div>
