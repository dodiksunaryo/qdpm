<h1><?php echo __('Enter your e-mail address below') ?></h1>

<form id="restorePassword" action="<?php echo url_for('login/restorePassword') ?>" method="POST">
  <table class="contentTable">
    <?php echo $form ?>
  </table>
  <br>
  <input type="submit" value="<?php echo __('Send New Password') ?>" class="btn" />
</form>

<?php include_partial('global/formValidator',array('form_id'=>'restorePassword')); ?>