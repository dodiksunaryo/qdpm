<?php

function renderUserPhoto($img)
{  
  if(strlen($img)>0)
  {
    return image_tag('/uploads/users/' . $img, array('style'=>'width: 50px;','absolute'=>true));
  }
  else
  {
    return image_tag('no_photo.png',array('absolute'=>true));
  }
}

function renderBackgroundColorBlock($v,$color)
{
   if(strlen($color)>0)
   {
    $rgb = convertHtmlColorToRGB($color);

    if(($rgb[0]+$rgb[1]+$rgb[2])<480)
    {
      return '<div class="background_color_item whiteText" style="background: #' . $color . '; color: white;">' . $v . '</div>';
    }
    else
    {
      return '<div class="background_color_item" style="background: #' . $color . ';">' . $v . '</div>';
    }
   }
   else
   {
     return $v;
   }
}

function convertHtmlColorToRGB($color)
{
    if ($color[0] == '#') $color = substr($color, 1);

    if (strlen($color) == 6)
    {
      list($r, $g, $b) = array($color[0].$color[1],$color[2].$color[3],$color[4].$color[5]);
    }
    elseif (strlen($color) == 3)
    {
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    }
    else
    {
        return array();
    }

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}

function renderBooleanValue($v)
{
  if($v==1)
  {
    return __('Yes');
  }
  else
  {
    return '<font color="lightGray">' . __('No') . '</font>';
  }
}


function replaceTextToLinks($text)
{    
  preg_match_all('|<pre>(.*)<\/pre>|U', $text, $matches);  
    
  $pre = array();
  foreach($matches[0] as $v)
  {      
    $code_id = '<code' . mt_rand() . '>';
    $pre[$code_id] = $v;
    $text = str_replace($v,$code_id,$text);
  }
            
  $text = str_replace('<a href','<a target="_balnk" href',$text);    
  $text = auto_link_text($text,'urls',array('target'=>'_blank'),true,85);    
  $text = preg_replace_callback('/<a(.*)>(.*)<\/a>/','truncateLongLinks',$text);    
  $text = preg_replace_callback('/<script(.*)>(.*)<\/script>/si','convertJavascriptSpceialCharacters',$text);
  
  foreach($pre as $code_id=>$v)
  {       
    $v = str_replace('<pre>','<pre class="code" id="' . str_replace(array('<','>'),'',$code_id) .  '">',$v);    
    $text = str_replace($code_id,$v,$text);
  }
                          
  return $text;
}

function convertJavascriptSpceialCharacters($matches)
{                   
  return htmlspecialchars($matches[0]);
}

function truncateLongLinks($matches)
{
  $link_text = $matches[2];
  
  if(strlen($link_text)>55) $link_text = substr($link_text,0,30) . ' ... ' . substr($link_text,-20);
  
  return '<a ' . $matches[1] . '>' . $link_text . '</a>';
}

function weeksDif($start, $end)
{
  $year_start = date('Y',$start);
  $year_end = date('Y',$end);
  
  $week_start = date('W',$start); 
  $week_end = date('W',$end);
  
  $dif_years = $year_end - $year_start;
  $dif_weeks = $week_end - $week_start;
  
  if($dif_years==0 and $dif_weeks==0)
  {
    return 0;
  }
  elseif($dif_years==0 and $dif_weeks>0)
  {
    return $dif_weeks;
  }
  elseif($dif_years==1)
  {
    return (42-$week_start)+$week_end;
  }
  elseif($dif_years>1)
  {
    return (42-$week_start)+$week_end+(($dif_years-2)*42);
  }

  
}

function monthsDif($start, $end)
{
  // Assume YYYY-mm-dd - as is common MYSQL format
  $splitStart = explode('-', date('Y-n',$start));
  $splitEnd = explode('-', date('Y-n',$end));

  if (is_array($splitStart) && is_array($splitEnd)) 
  {
      $startYear = $splitStart[0];
      $startMonth = $splitStart[1];
      $endYear = $splitEnd[0];
      $endMonth = $splitEnd[1];

      $difYears = $endYear - $startYear;
      $difMonth = $endMonth - $startMonth;

      if (0 == $difYears && 0 == $difMonth) 
      { // month and year are same
          return 0;
      }
      else if (0 == $difYears && $difMonth > 0) 
      { // same year, dif months
          return $difMonth;
      }
      else if (1 == $difYears) 
      {
          $startToEnd = 13 - $startMonth; // months remaining in start year(13 to include final month
          return ($startToEnd + $endMonth); // above + end month date
      }
      else if ($difYears > 1) 
      {
          $startToEnd = 13 - $startMonth; // months remaining in start year 
          $yearsRemaing = $difYears - 2;  // minus the years of the start and the end year
          $remainingMonths = 12 * $yearsRemaing; // tally up remaining months
          $totalMonths = $startToEnd + $remainingMonths + $endMonth; // Monthsleft + full years in between + months of last year
          return $totalMonths;
      }
  }
  else 
  {
    return false;
  }
}