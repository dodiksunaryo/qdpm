<?php if(count($filter_by)>0): ?>
<table>
  <tr>
<?php 
$count = 0;
foreach($filter_tables as $table=>$title): 

if(!isset($filter_by[$table])) continue;

if($count>5){ echo '</tr><tr>'; $count=0;}
$count++

?>    
    <td>
      <div class="filterPreviewBox">
        <table>
          <tr>
            <td valign="top" style="padding-top: 2px;"><?php echo link_to(image_tag('icons/close_gray.png'),'ganttChart/index?remove_filter=' . $table . ($params? '&' . $params:''),array('title'=>__('Remove Filter')))?></td>
            <td valign="top"><div id="filtersPreviewMenuBox">
            <?php 
                                      
              switch($table)
              {
                case 'TasksStatus':  $m =  app::getFilterMenuStatusItemsByTable(array(),$table,'Status','ganttChart/index',$params,$filter_by[$table]);
                  break;
                case 'TasksAssignedTo':  $m =  app::getFilterMenuUsers(array(),$table,'Assigned To','ganttChart/index',$params,$filter_by[$table]);
                  break;
                case 'TasksCreatedBy':  $m =  app::getFilterMenuUsers(array(),$table,'Created By','ganttChart/index',$params,$filter_by[$table]);
                  break;
                case 'Projects':  $m =  app::getFilterProjects(array(),'ganttChart/index',$params,$filter_by[$table],$sf_user); 
                  break;                  
                default: $m = app::getFilterMenuItemsByTable(array(),$table,$title,'ganttChart/index',$params,$filter_by[$table],$sf_user);                 
                  break;
              }
            
              
              echo renderYuiMenu('filtersMenu' . $table,$m);
                 
                
            ?></div></td>
            <td valign="top" class="selectedFilterItems"><?php echo (strstr($table,'extraField')? $filter_by[$table] : app::getNameByTableId($table,$filter_by[$table]))?></td>
          </tr>
        </table>
      </div>
      
      <script type="text/javascript">
          YAHOO.util.Event.onContentReady("filtersMenu<?php echo $table ?>", function () {
              var oMenuBar = new YAHOO.widget.MenuBar("filtersMenu<?php echo $table ?>", {autosubmenudisplay: true,hidedelay: 350,submenuhidedelay: 0,scrollincrement:10,showdelay: 150,keepopen: true,lazyload: true });
              oMenuBar.render();
          });
      </script>
      
    </td>
<?php endforeach ?>    
  </tr>
</table>
<?php endif ?>