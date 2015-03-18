<h1><?php echo __('Sort Items') ?></h1>

<?php echo __('Just move an item up or down.') ?>

<ul id="sorted_items" class='droptrue'>
  <?php
    foreach($itmes as $v)
    {
      echo '<li id="field_' . $v->getId() . '">' . $v->getName() . '</li>';
    }
  ?>
</ul>

<?php echo button_to_tag(__('Save'),$sf_request->getParameter('t') . '/index' . ($sf_request->hasParameter('bind_type')?'?bind_type=' . $sf_request->getParameter('bind_type'):'')) ?>

<script>
$(function() {
	$( "ul.droptrue" ).sortable({
		connectWith: "ul",
		update: function(event,ui){ droppableOnUpdate('<?php echo url_for("app/SortItemsProcess?t=" . $sf_request->getParameter("t"))?>') }
	});
});

</script>