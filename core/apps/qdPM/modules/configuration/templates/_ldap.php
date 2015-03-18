<div class="infoBlock"><h1><?php echo __('LDAP Configuration') ?></h1></div>
<br>
<table class="contentTable">
  <tr>
    <th><label for="cfg_app_use_ldap_login"><?php echo __('Use LDAP Login'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_ldap_login]',sfConfig::get('app_use_ldap_login'), array('choices'=>$default_selector)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_default_user_group"><?php echo __('Default Group'); ?></label></th>
    <td><?php echo select_tag('cfg[app_ldap_default_user_group]',sfConfig::get('app_ldap_default_user_group'), array('choices'=>UsersGroups::getChoicesByType(false,true))); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_host"><?php echo __('LDAP server name'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_server]', sfConfig::get('app_ldap_server'),array('size'=>40)) . '<br><i>' . __('If using LDAP this is the hostname or IP address of the LDAP server. Alternatively you can specify a URL like ldap://hostname:port/') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_port"><?php echo __('LDAP server port'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_port]', sfConfig::get('app_ldap_port'),array('size'=>40)). '<br><i>' . __('Optionally you can specify a port which should be used to connect to the LDAP server instead of the default port 389.') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_base_dn"><?php echo __('LDAP base dn'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_base_dn]', sfConfig::get('app_ldap_base_dn'),array('size'=>40)). '<br><i>' . __('This is the Distinguished Name, locating the user information, e.g. o=My Company,c=US.') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_version"><?php echo __('LDAP uid'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_uid]', sfConfig::get('app_ldap_uid'),array('size'=>40)). '<br><i>' . __('This is the key under which to search for a given login identity, e.g. uid, sn, etc.') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_version"><?php echo __('LDAP user filter'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_user_filter]', sfConfig::get('app_ldap_user_filter'),array('size'=>40)). '<br><i>' . __('Optionally you can further limit the searched objects with additional filters.<br>For example objectClass=posixGroup would result in the use of (&(uid=$username)(objectClass=posixGroup))') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_version"><?php echo __('LDAP e-mail attribute'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_email]', sfConfig::get('app_ldap_email'),array('size'=>40)). '<br><i>' . __('Set this to the name of your user entry e-mail attribute (if one exists) in order to automatically set the e-mail address for new users.<br>User email is required for qdPM and if it\'s not exist qdPM atumatically assign email like username@localhost.com') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_version"><?php echo __('LDAP user dn'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_user]', sfConfig::get('app_ldap_user'),array('size'=>40)). '<br><i>' . __('Leave blank to use anonymous binding. If filled in uses the specified distinguished name on login attempts to find the correct user, e.g. uid=Username,ou=MyUnit,o=MyCompany,c=US. ') . '</i>'; ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_ldap_version"><?php echo __('LDAP password'); ?></label></th>
    <td><?php echo input_tag('cfg[app_ldap_password]', sfConfig::get('app_ldap_password'),array('size'=>40)). '<br><i>' . __('Leave blank to use anonymous binding. Otherwise fill in the password for the above user. <br><b>Warning:</b> This password will be stored as plain text in the database visible to everybody who can access your database or who can view this configuration page.') . '</i>'; ?></td>
  </tr>   
</table>  

