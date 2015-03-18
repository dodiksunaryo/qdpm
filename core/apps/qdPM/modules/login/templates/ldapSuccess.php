<div class="infoBlock"><h1><?php echo __('LDAP Login') ?></h1></div>
<br>

<?php
if((int)sfConfig::get('app_ldap_default_user_group')==0)
{
  echo __('Default users group for LDAP users is not setup. LDAP login is not allowed.');
}
else
{
?>

<form name="LdapLoginForm" id="LdapLoginForm" onSubmit="return validateForm(this.id, '<?php echo url_for('home/validateForm',true); ?>')" action="<?php echo url_for('login/ldap',true) ?>" method="POST">
<input type="hidden" name="formName" value="LdapLoginForm" />
  <table class="contentTable">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" class="btn" value="<?php echo __('Login') ?>" />
      </td>
    </tr>

  </table>
</form>
<?php } ?>