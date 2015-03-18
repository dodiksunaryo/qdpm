<h1><?php echo (strlen($h = sfConfig::get('app_login_page_heading'))>0 ? $h :__('Login')) ?></h1>
<br>

<?php if(strlen($c = strip_tags(sfConfig::get('app_login_page_content')))>0):?>
<table class="contentTable" style="margin-bottom: 7px;">
<tr>
  <td><?php echo $c ?></td>
</tr>
</table>
<?php endif ?>

<?php $form->setDefault('email',base64_decode($sf_request->getCookie('remember_user'))) ?>

<form name="loginForm" id="loginForm" action="<?php echo url_for('login/index',true) ?>" method="POST">
  <table class="contentTable">
    <?php echo $form ?>
    <tr>
      <td></td>
      <td><?php echo input_checkbox_tag('remember_me',1,array('checked'=>$sf_request->getCookie('remember_me'))) . ' <label for="remember_me">' . __('Remember Me') . '</label>' ?></td>
    </tr>          
    <tr>
      <td colspan="2" style="padding: 7px 0;">
        <input type="submit" value="<?php echo __('Login') ?>" class="btn" />
      </td>
    </tr>
    <tr>
      <td colspan="2"><?php 
        echo link_to(__('Password forgotten?'),'login/restorePassword'); 
        if(sfConfig::get('app_use_ldap_login'))
        {
          echo ' | ' . link_to('LDAP Login','login/ldap');
        }
        ?></td>
    </tr>
  </table>
  <?php
  $http_referer = '';
      
  if(isset($_SERVER['REQUEST_URI']))
  {
    if(!stristr($_SERVER['REQUEST_URI'],'/login') and !stristr($_SERVER['REQUEST_URI'],'/create') and !stristr($_SERVER['REQUEST_URI'],'/edit') and !stristr($_SERVER['REQUEST_URI'],'/update') and !stristr($_SERVER['REQUEST_URI'],'/new'))
    {
      if(isset($_SERVER['HTTPS']))
      {
        $http_referer = ($_SERVER['HTTPS']=='on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      }
      else
      {
        $http_referer = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      }
    }
  }
  
  echo input_hidden_tag('http_referer', $http_referer); ?>
</form>

<?php include_partial('global/formValidator',array('form_id'=>'loginForm')); ?>