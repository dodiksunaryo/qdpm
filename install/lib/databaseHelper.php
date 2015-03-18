<?php

  function tep_db_connect($server, $username, $password, $link = 'db_link') {
    global $$link, $db_error;

    $db_error = false;

    if (!$server) {
      $db_error = 'No Server selected.';
      return false;
    }

    $$link = @mysql_connect($server, $username, $password) or tep_db_error(mysql_error());
    
    tep_db_query("set names utf8");

    return $$link;
  }

  function tep_db_select_db($database) {
    if(!mysql_select_db($database)) tep_db_error(mysql_error());
  }

  function tep_db_query($query, $link = 'db_link') {
    global $$link;

    if(strlen(trim($query))>0)
    {
      return mysql_query($query, $$link) or die('Error: ' . mysql_errno() . ' - ' . mysql_error() . '<br><br>' . $query );
    }
  }
  
  function tep_db_error($error)
  {
    header('Location: index.php?step=database_config&db_error=' . urlencode($error));
    exit();
  }