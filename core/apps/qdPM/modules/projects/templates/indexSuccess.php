<div class="pageHeading">
<table>
  <tr>
    <td><span class="pageHeading"><?php echo __('Projects') ?></span></td>
    <td style="padding-left: 15px;"><?php include_component('projects','filters') ?></td>
    <td style="padding-left: 15px;"><?php include_component('app','orderByMenu',array('module'=>'projects')) ?></td>
    <td style="padding-left: 15px;"><?php include_component('app','searchMenu') ?></td>
  </tr>  
</table>
</div>

<div><?php if(!$sf_request->hasParameter('search')) include_component('projects','filtersPreview') ?></div>

<?php include_component('projects','listing') ?>
