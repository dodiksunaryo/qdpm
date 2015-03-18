<div class="doctrine_pager">
<?php  
if(sfConfig::get('app_rows_limit')>0)
{         
  $url = $sf_context->getModuleName() . '/' . $sf_context->getActionName() . '?' . $url_params  . (strlen($url_params)>0 ? '&':'') . 'page=';
  
  echo  __('Total') . ': ' . $pager->getNbResults(); 
      
  if ($pager->haveToPaginate() && $sf_context->getModuleName()!='dashboard')
  {       
    echo '<br />'  . __('Displaying') . ' ' . $pager->getFirstIndice()  . ' - ' .  $pager->getLastIndice();
    
    echo ' ' . link_to('&laquo;', $url.$pager->getFirstPage())  . ' ' . link_to('&lt;', $url.$pager->getPreviousPage()) . ' ';
    $links = $pager->getLinks(); 
    
    foreach ($links as $page)
    { 
      echo ($page == $pager->getPage()) ? $page : link_to($page, $url.$page) ; 
      if ($page != $pager->getCurrentMaxLink()) echo ' - '; 
    }  
    
    echo ' ' . link_to('&gt;', $url.$pager->getNextPage()) . ' '  . link_to('&raquo;', $url.$pager->getLastPage()) ;
  }
  elseif ($pager->haveToPaginate() && $sf_context->getModuleName()=='dashboard')
  {
    echo '<br />'  . __('Displaying') . ' ' . $pager->getFirstIndice()  . ' - ' .  $pager->getLastIndice() . '&nbsp;&nbsp;' . link_to(__('View more'),$reports_action . '/view?id=' . $reports_id);    
  }
}
else
{
  echo  __('Total') . ': ' . $total;
}  
?>  

</div>