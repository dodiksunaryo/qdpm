<h1><?php echo __('Sort Items') ?></h1>

<?php echo __('Just move an item up or down.') ?>
<br>
<?php 
foreach(app::getStatusGroupsChoices() as $k=>$name): 
  
  echo '<b>' . $name . '</b>';
?>

<ul id="sorted_items_<?php echo $k ?>" class='droptrue'>
  <?php
    foreach($itmes as $v)
    {
      if($v->getGroup()==$k)
      {
        echo '<li id="field_' . $v->getId() . '">' . $v->getName() . '</li>';
      }
    }
  ?>
</ul>
<?php endforeach ?>

<?php echo button_to_tag(__('Save'),$sf_request->getParameter('t') . '/index') ?>

<script>
$(function() {
	$( "ul.droptrue" ).sortable({
		connectWith: "ul",
		update: function(event,ui){ droppableOnUpdate('<?php echo url_for("app/SortGroupedItemsProcess?t=" . $sf_request->getParameter("t"))?>') }
	});
	
});

</script>