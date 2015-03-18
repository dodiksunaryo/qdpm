<div id="<?php echo $id ?>" class="jsPager" >
		<table>
		  <tr>
        <td><?php echo image_tag('icons/control_start.png',array('class'=>'first', 'title'=>__('First Page'))) ?></td>
		    <td><?php echo image_tag('icons/control_rewind.png',array('class'=>'prev', 'title'=>__('Previous Page'))) ?></td>
		    <td style="padding-left: 20px;"><?php echo __('Page')?>: <input type="text" class="pagedisplay" style="background: transparent; border: 0px;  width: 40px;" disabled></td>
		    <td><?php echo image_tag('icons/control_fastforward.png',array('class'=>'next', 'title'=>__('Next Page'))) ?></td>
		    <td><?php echo image_tag('icons/control_end.png',array('class'=>'last', 'title'=>__('Last Page'))) ?></td>
		    <td><input type="hidden" class="pagesize" value="<?php echo sfConfig::get('app_rows_per_page')?>"></td>
	   </tr>
	  </table>				
</div>