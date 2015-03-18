<h1><?php echo __('Tasks Listing') ?></h1>
<br>
<div><?php echo __('Select tasks fields which will be display in tasks listing by default.'); ?></div>
<br>

<?php echo select_tag('cfg[app_tasks_columns_list]',explode(',',sfConfig::get('app_tasks_columns_list')),array('choices'=>Tasks::getTasksColumnChoices(),'expanded'=>true,'multiple'=>true)) ?>
    