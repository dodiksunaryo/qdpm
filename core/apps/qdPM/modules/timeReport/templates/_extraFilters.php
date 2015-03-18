<table>
  <tr>
    <td>
    
    <?php if($action_name=='index'){ ?>
      <form action="<?php echo url_for('timeReport/' . $action_name) ?>" method="post">
      <table>
        <tr>
          <td><?php echo __('User')?>:&nbsp;</td>
          <td><?php echo select_tag('filter_by[CommentCreatedBy]',(isset($filter_by['CommentCreatedBy'])?$filter_by['CommentCreatedBy']:''),array('choices'=>Users::getChoices(array(),'tasks_comments_insert',true)),array('onChange'=>'this.form.submit()'))?></td>          
        </tr>
      </table>
      <?php echo ($sf_request->hasParameter('projects_id')? input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')):'') ?>
      </form>
    <?php }else {?>
    
      <table>
        <tr>
          <td><?php echo __('User')?>:&nbsp;</td>
          <td><?php $user = $sf_user->getAttribute('user'); echo $user->getName() ?></td>          
        </tr>
      </table>
    <?php } ?>
      
    <td style="padding-left: 10px;">
      <form action="<?php echo url_for('timeReport/'. $action_name) ?>" method="post">
      <table>
        <tr>
          <td><?php echo __('Discrepancy:')?>:&nbsp;</td>
          <td><?php echo select_tag('filter_by[TimeDiscrepancy]',(isset($filter_by['TimeDiscrepancy'])?$filter_by['TimeDiscrepancy']:''),array('choices'=>array(''=>__('All'),'under'=>__('Under'),'over'=>__('Over'),'ok'=>__('Ok'))),array('onChange'=>'this.form.submit()'))?></td>          
        </tr>
      </table>
      <?php echo ($sf_request->hasParameter('projects_id')? input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')):'') ?>
      </form>
    </td>  
    <td style="padding-left: 30px;">
      <form action="<?php echo url_for('timeReport/' . $action_name) ?>" method="post">
      <table>
        <tr>
          <td><?php echo __('From')?>:&nbsp;</td>
          <td><?php echo input_tag('filter_by[CommentCreatedFrom]',(isset($filter_by['CommentCreatedFrom'])?$filter_by['CommentCreatedFrom']:date('Y-m-d')),array('class'=>'datepicker'))?></td>
          <td>&nbsp;&nbsp;<?php echo __('To')?>:&nbsp;</td>
          <td><?php echo input_tag('filter_by[CommentCreatedTo]',(isset($filter_by['CommentCreatedTo'])?$filter_by['CommentCreatedTo']:''),array('class'=>'datepicker'))?></td>
          <td>&nbsp;<input type="submit" class="btn" value="<?php echo  __('Filter By Dates')?>"></td>
        </tr>
      </table>
      <?php echo ($sf_request->hasParameter('projects_id')? input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')):'') ?>
      </form>
    </td>
  </tr>
</table>  

<script type="text/javascript">    
  $(function() {  
    $( "input.datepicker" ).each(function() { $(this).datepicker({ dateFormat: 'yy-mm-dd' }) });                                                               
  });
</script>      
    