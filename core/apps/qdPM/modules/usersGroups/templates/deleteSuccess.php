<h1><? echo __('Delete?')?></h1>

<?php 
if($count_users==0)
{ 
    echo __('Are you sure you want to delete Group?') . ' <b>' . $users_groups->getName() . '</b> ?<br>';
    echo '<form action="' . url_for('usersGroups/delete?id=' . $users_groups->getId()) . '" method="post"><input type="hidden" name="sf_method" value="put" />' . submit_tag(__('Delete')) . '</form>';
}
else
{
   echo __("You can't delete this Group because there are Users assigned to this Group.")  . '<br>' . __('You have to delete users first.');
}    
?>