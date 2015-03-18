<div id="userMenuContainer">
  <div id="userMenuBox"><?php $m = new menuController($sf_user,$sf_request); echo renderYuiMenu('user_menu',$m->buildUserMenu()) ?></div>
</div>

<script type="text/javascript">
    YAHOO.util.Event.onContentReady("user_menu", function () 
    {
        var oMenuBar = new YAHOO.widget.MenuBar("user_menu", {
                                                autosubmenudisplay: true,
                                                hidedelay: 750,
                                                submenuhidedelay: 0,
                                                showdelay: 150,
                                                lazyload: true });
        oMenuBar.render();
    });
</script>
