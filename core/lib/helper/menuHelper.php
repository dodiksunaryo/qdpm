<?php
  
  function renderMenu($menu = array(),$class='menu', $id='navigationMenu',$html='',$level=0)
  { 
    if($level==0)
    {     
      $html .= '
        <ul id="' . $id . '">';
    }
    elseif($level==1)
    {
      $html .= '
        <ul class="' . $id . ' first">';
    }
    else
    {
      $html .= '
        <ul class="' . $id . ' level' . $level . '">';
    }
      
      for($i=0; $i<sizeof($menu); $i++)
      {
      
        $url = '';
        
        if(isset($menu[$i]['url']))
        {
          if(isset($menu[$i]['modalbox']))
          {
            $url = 'onClick="openModalBox(\'' . url_for($menu[$i]['url'],true). '\')"';
          }
          elseif(isset($menu[$i]['mamodalbox']))
          {
            $url = 'onClick="openMultipleActionModalBox(\'' . url_for($menu[$i]['url'],true). '\')"';
          }
          else
          {
            $url = 'onClick="location.href=\'' . url_for($menu[$i]['url'],true). '\'"';
            $menu[$i]['title'] = '<a href="' . url_for($menu[$i]['url'],true) . '">' . $menu[$i]['title'] . '</a>';
          }
        }
        elseif(isset($menu[$i]['onClick']))
        {
          $url = 'onClick="' . $menu[$i]['onClick'] . '"';
        }
      
        $html .= '
          <li>';
        
        if($i==0 and $level>0)
        {
          $html .= '
              <div class="' . $class . 'SubHeader"></div>
          ';
        }  
        
        $menu_arrow_calss = '';
        
        if(isset($menu[$i]['submenu']) and $level == 0)
        {
          if(count($menu[$i]['submenu'])>0)
          {
            $menu_arrow_calss = 'class="menuArrowBottom"';
          }
        }
        
        if(isset($menu[$i]['submenu']) and $level>0)
        {
          if(count($menu[$i]['submenu'])>0)
          {
            $menu_arrow_calss = 'class="menuArrowRight"';
          }
        }
        
        if(!isset($menu[$i]['is_selected'])) $menu[$i]['is_selected'] = false;
        if(!isset($menu[$i]['is_hr'])) $menu[$i]['is_hr'] = false;
          
        $html .= '
              <div class="' . $class . ($level>0?'Sub':'')  . ($menu[$i]['is_selected']?' selected': '')  . ($menu[$i]['is_hr']?' hr': '') . '"><div ' . $menu_arrow_calss .  ' ' . $url . '>';
                                    
       if(isset($menu[$i]['icon']))
       {         
         $html .= '<table><tr><td style="padding-right: 5px;">' . image_tag('icons/' . $menu[$i]['icon']) . '</td><td>' . $menu[$i]['title']. '</td></tr></table>';
       }
       else
       {
         $html .= $menu[$i]['title'];
       }
       
         $html .= '</div></div>';     
              
          
        if(isset($menu[$i]['submenu']))
        {
          $html = renderMenu($menu[$i]['submenu'], $class, $id,$html,$level+1);
        }
        
        if(!isset($menu[$i+1]) and $level>0)
        {
          $html .= '
            <div class="' . $class . 'SubFooter level' . $level . '"></div>
          ';
        }  
        
        $html .= '
          </li>' . "\n";  
      }  
      
    $html .= '
      </ul>';
    
    return $html;    
  } 
  
  function renderYuiMenu($id, $m, $html = '', $level=0)
  {
    if($level==0)
    {
      $html .= '
        <div id="' . $id . '" class="yuimenubar yuimenubarnav" style="display: none">
          <div class="bd">
            <ul>' . "\n";
    }
    else
    {
      $html .= '
        <div id="' . $id  . mt_rand() . '" class="yuimenu">
          <div class="bd">
            <ul>' . "\n";
    }
    
    foreach($m as $v)
    {            
      if(isset($v['is_hr']))
      {
        if($v['is_hr']==true)
        {
          $html .= '</ul><ul>';
        }
      }
      
      $selected_class = '';
      if(isset($v['is_selected']))
      {
        if($v['is_selected']==true)
        {
          $selected_class = ' yuimenuselecteditem';
        }
      }
      
      if(isset($v['onClick']))
      {      
        $html .= '
              <li class="' . ($level==0?'yuimenubaritem':'yuimenuitem')  . $selected_class . '" onClick="' . $v['onClick'] . '"><span>' . $v['title'] . '</span>';    
      }
      elseif(isset($v['modalbox']))
      {      
        $html .= '
              <li class="' . ($level==0?'yuimenubaritem':'yuimenuitem') . $selected_class . '" onClick="openModalBox(\'' . url_for($v['url'],true). '\')"><span>' . $v['title'] . '</span>';    
      }
      elseif(isset($v['mamodalbox']))
      {      
        $html .= '
              <li class="' . ($level==0?'yuimenubaritem':'yuimenuitem') . $selected_class . '" onClick="openMultipleActionModalBox(\'' . url_for($v['url'],true). '\')"><span>' . $v['title'] . '</span>';    
      }
      elseif(isset($v['url']))
      {
        $html .= '
                <li class="' . ($level==0?'yuimenubaritem':'yuimenuitem') . $selected_class . '"><a ' . (isset($v['confirm'])?'onClick="return confirm(\'' . __('Are you sure?') . '\')"':''). ' class="' . ($level==0?'yuimenubaritemlabel':'yuimenuitemlabel') . '" href="' . (isset($v['url']) ? url_for($v['url']) : '#'). '"  ' . (isset($v['target'])? 'target="' . $v['target'] . '"' : ''). '>' . $v['title']. '</a>';
      }
      else
      {
        $html .= '
              <li class="' . ($level==0?'yuimenubaritem':'yuimenuitem') . $selected_class . '"><span>' . $v['title'] . '</span>';
      }

      if(isset($v['submenu']))
      {
        if(count($v['submenu'])>0)
        {
          $html = renderYuiMenu($id, $v['submenu'],$html,$level+1);
        }
      }

      $html .= '</li>' . "\n";
    }
    
    $html .= '
            </ul>
          </div>
        </div>';
        
    return $html;
  }
  
  function convertChoicesToYuiMenu($id, $choices,$multiple,$expanded)
  {
    if($multiple or $expanded)
    {
      return '';
    }
    
    $m = array();
    
    foreach($choices as $k=>$v)
    {                         
      $s = array();
      
      if(is_array($v))
      {
        foreach($v as $kk=>$vv)
        {
          $s[] = array('title'=>$vv,'onClick'=>'setFieldValueById(\'' .$id . '\',\'' . $kk . '\')');
        }
      }
      
      if(count($s)>0)
      {
        $m[] = array('title'=>$k,'submenu'=>$s);
      }
      else
      {
        $m[]=array('title'=>$v,'onClick'=>'setFieldValueById(\'' .$id . '\',\'' . $k . '\')');
      }
    }
    
    $m = array(array('title'=>'&nbsp;','submenu'=>$m));
    
    return  '<div id="yuiChoicesMenuContainer">'  . renderYuiMenu($id . '_yui_menu',$m)  . '</div>
      <script type="text/javascript">
        var oMenuBar' . $id . ';
        YAHOO.util.Event.onContentReady("' . $id . '_yui_menu", function () 
        {
            if(oMenuBar' . $id . ') oMenuBar' . $id . '.destroy();
            
            oMenuBar' . $id . ' = new YAHOO.widget.MenuBar("' . $id . '_yui_menu", {autosubmenudisplay: true,hidedelay: 350,submenuhidedelay: 0,showdelay: 150,lazyload: true });                        
            oMenuBar' . $id . '.render();                        
        });        
      </script>
    ';
  }  