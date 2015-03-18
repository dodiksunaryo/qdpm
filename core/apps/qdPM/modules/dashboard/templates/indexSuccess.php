<?php 
  echo '<div style="padding-top: 5px;">' . link_to_modalbox(__('Configure Dashboard'),'dashboard/configure') . '</div>';
  
  if(count($reports)==0) echo '<br><div>' . __('No reports found to display on dashboard') . '</div>';
  
  foreach($reports as $report)
  {    
  
    switch(true)
    {       
      case strstr($report,'projectsReports'):
          if($r = Doctrine_Core::getTable('ProjectsReports')->find(str_replace('projectsReports','',$report)))
          {  
            echo '
              <h1>' . (in_array($report,$hidden_dashboard_reports) ? image_tag('icons/plus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')')):image_tag('icons/minus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')'))) . ' <a href="' . url_for('projectsReports/view?id=' . $r->getId()) . '">' . $r->getName() . '</a></h1> 
              <div style="margin-bottom: 15px; display:' . (in_array($report,$hidden_dashboard_reports) ? 'none':'block'). '" id="' . $report . '">' . get_component('projects','listing',array('reports_id'=>$r->getId(), 'is_dashboard'=>true)) . '</div>
            ';
          } 
        break;
      case strstr($report,'userReports'):
          if($r = Doctrine_Core::getTable('UserReports')->find(str_replace('userReports','',$report)))
          {  
            echo '
              <h1>' . (in_array($report,$hidden_dashboard_reports) ? image_tag('icons/plus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')')):image_tag('icons/minus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')'))) . ' <a href="' . url_for('userReports/view?id=' . $r->getId()) . '">' . $r->getName() . '</a></h1>
              <div style="margin-bottom: 15px; display:' . (in_array($report,$hidden_dashboard_reports) ? 'none':'block'). '" id="' . $report . '">' . get_component('tasks','listing',array('reports_id'=>$r->getId(), 'is_dashboard'=>true)) . '</div>
            ';
          } 
        break;
      case strstr($report,'ticketsReports'):
          if($r = Doctrine_Core::getTable('TicketsReports')->find(str_replace('ticketsReports','',$report)))
          {  
            echo '
              <h1>' . (in_array($report,$hidden_dashboard_reports) ? image_tag('icons/plus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')')):image_tag('icons/minus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')'))) . ' <a href="' . url_for('ticketsReports/view?id=' . $r->getId()) . '">' . $r->getName() . '</a></h1>
              <div style="margin-bottom: 15px; display:' . (in_array($report,$hidden_dashboard_reports) ? 'none':'block'). '" id="' . $report . '">' . get_component('tickets','listing',array('reports_id'=>$r->getId(), 'is_dashboard'=>true)) . '</div>
            ';
          } 
        break;
      case strstr($report,'discussionsReports'):
          if($r = Doctrine_Core::getTable('DiscussionsReports')->find(str_replace('discussionsReports','',$report)))
          {  
            echo '
              <h1>' . (in_array($report,$hidden_dashboard_reports) ? image_tag('icons/plus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')')):image_tag('icons/minus_large.png',array('id'=>$report . 'icon','onClick'=>'expand_dashboard_report(\'' . $report . '\',\'' . url_for('dashboard/expandReport') . '\')'))) . ' <a href="' . url_for('discussionsReports/view?id=' . $r->getId()) . '">' . $r->getName() . '</a></h1>
              <div style="margin-bottom: 15px; display:' . (in_array($report,$hidden_dashboard_reports) ? 'none':'block'). '" id="' . $report . '">' . get_component('discussions','listing',array('reports_id'=>$r->getId(), 'is_dashboard'=>true)) . '</div>
            ';
          } 
        break;
    }
  }
?>