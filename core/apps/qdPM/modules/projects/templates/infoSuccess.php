<h1><?php echo $projects->getName() ?></h1>

<table class="contentTable" >
<tr>
  <td style="width:400px">
    <div><?php echo  replaceTextToLinks($projects->getDescription()) ?></div>
    <div><?php include_component('attachments','attachmentsList',array('bind_type'=>'projects','bind_id'=>$projects->getId())) ?></div>
  </td>
  <td style="width:300px">
    <div id="itemDetailsContainer">
      <div id="itemDetailsBox">        
        <?php include_component('projects','details',array('projects'=>$projects)) ?>
      </div>
    </div>
  </td>
</tr>
</table>