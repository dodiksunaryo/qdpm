<div id="userNoticesContainer">
  <div id="userNoticesBox">
    <?php 
      if(is_array($userNotices))
      {
        switch($userNotices['type'])
        {
          case 'error':
              echo '<div class="userNoticesError">' . __('Error') . ': ' . $userNotices['text'] . '</div>';
            break;
          case 'warning':
              echo '<div class="userNoticesWarning">' . __('Warning') . ': ' . $userNotices['text'] . '</div>';
            break;
          case 'info':
              echo '<div class="userNoticesInfo">' . $userNotices['text'] . '</div>';
            break;  
        }
      }
      else
      {
        echo '<div class="userNoticesInfo">' . $userNotices . '</div>';        
      }
     ?>
  </div>
</div>

<script type="text/javascript">
  $(function() {
    $("#userNoticesContainer").delay(10000).fadeOut();
  });
</script>