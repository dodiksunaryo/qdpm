<h1><?php echo $users->getName() ?></h1>

<table class="contentTable">
  <tr>
    <td><?php echo __('Group') ?>:</td>
    <td><?php echo $users->getUsersGroups()->getName() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Email') ?>:</td>
    <td><?php echo $users->getEmail() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Photo') ?>:</td>
    <td><?php echo renderUserPhoto($users->getPhoto()) ?></td>
  </tr>
  
  <?php echo ExtraFieldsList::renderInfoFileds('users',$users,$sf_user) ?>
  
</table>  