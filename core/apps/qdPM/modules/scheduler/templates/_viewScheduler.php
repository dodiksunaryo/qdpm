<?php

  // 3. Выводим содержимое массива $week
  // в виде календаря
  // Выводим таблицу
  
    
  echo '
    <div class="schedulerFilterBar">
      ' . link_to(__('Previous Month'),$sf_context->getModuleName() . '/' . $sf_context->getActionName() . '?month=prev_month') . '
      &nbsp;&nbsp;<b>' . app::i18n_date('F Y', $sf_user->getAttribute($scheduler_time)) . '</b>&nbsp;&nbsp;
      ' . link_to(__('Next Month'), $sf_context->getModuleName() . '/' . $sf_context->getActionName() . '?month=next_month') . '
      &nbsp;&nbsp;' . (date('Y-m', $sf_user->getAttribute($scheduler_time))!=date('Y-m') ? link_to(__('Back to ') . app::i18n_date('j F Y'),$sf_context->getModuleName() . '/' . $sf_context->getActionName() . '?month=current_month') :''). '
      &nbsp;&nbsp;' . __('Today') . ': ' . app::i18n_date('j F Y') . '
    </div>
  ';
  
  echo '
  <table class="schedulerTable">
    <tr>
      <th>' . __('Monday') . '</th>
      <th>' . __('Tuesday') . '</th>
      <th>' . __('Wednesday') . '</th>
      <th>' . __('Thursday') . '</th>
      <th>' . __('Friday') . '</th>
      <th>' . __('Saturday') . '</th>
      <th>' . __('Sunday') . '</th>
    </tr>  
  ';
    
  
  for($i = 0; $i < count($week); $i++)
  {
    echo "<tr>";
    for($j = 0; $j < 7; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        // Если имеем дело с субботой и воскресенья
        // подсвечиваем их
        $heading_calass='schedulerDayHeading';
        if($j == 5 || $j == 6)
        {
          $heading_calass='schedulerWeekendHeading';
        }
        
        $td_class = '';
        if(date('Y-m-d',$week[$i][$j])==date('Y-m-d'))
        {
          $heading_calass='schedulerCurrentDayHeading';
          $td_class = 'class="schedulerCurrentDay"';
        } 
        
        $add_action = '';
        
        if($sf_context->getModuleName()=='scheduler' and $sf_user->hasCredential('public_scheduler_access_full_access') and $users_id==null)
        {
          $add_action = 'onClick="openModalBox(\'' . url_for('scheduler/new?day=' . $week[$i][$j]) . '\')"';
        }
        
        if($sf_context->getModuleName()=='scheduler' and $sf_user->hasCredential('allow_manage_personal_scheduler') and $users_id>0)
        {
          $add_action = 'onClick="openModalBox(\'' . url_for('scheduler/new?day=' . $week[$i][$j] . '&users_id=' . $users_id) . '\')"';
        }   
                                 
        echo '<td ' . $td_class . '><div class="' . $heading_calass . '"  ' . $add_action . '>' . date('d',$week[$i][$j]) . '</div>';
        
        echo Events::getEventsListByDate($week[$i][$j], $users_id, $sf_user); 
        
        echo '</td>';
        
      }
      else echo '<td class="inactiveDay">&nbsp;</td>';
    }
    echo "</tr>";
  } 
  echo "</table>";
