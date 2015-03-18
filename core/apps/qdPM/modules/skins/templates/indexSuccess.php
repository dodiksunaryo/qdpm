<h1><?php echo __('Skins'); ?></h1>

<div class="skinsList">
  <ul>
  <?php foreach($skins_list as $skin): ?>
    <li><?php echo $skin; ?><div style="border: 1px solid #b9b9b9; margin: 5px; width: 80px; height: 80px; cursor: pointer; background: white;" onClick="location='<?php echo url_for('skins/index?setSkin=' . $skin);?>'"><?php echo image_tag('/css/skins/' . $skin . '/preview.png'); ?></div></li>
  <?php endforeach ?>
  </ul>
</div>