function openModalBox(url)
{
  //destroy uploadify (IE9 required to open modalbox)
  if(document.getElementById('uploadify_file_upload')) $('#uploadify_file_upload').uploadify('destroy');

  jQuery.fn.modalBox({
    directCall : {
			source : url
		},
		usejqueryuidragable : true,
		killModalboxWithCloseButtonOnly: true    
	});	
}

function openMultipleActionModalBox(url)
{
  if(selected_items.length==0)
  {
    alert(I18NText('Please Select Items'));
    return false;
  }
  else
  {
    openModalBox(url)
  }
}

function setFieldValueById(id,v)
{
  $('#'+id).val(v).change();
}

function set_selected_items()
{
  if(selected_items.length>0)
  {
    $('#selected_items').val(selected_items.toString());
  }  
}

function I18NText(v)
{
  if(I18NJSText[v])
  {
    return I18NJSText[v];
  }
  else
  {
    return v;
  }
}

function droppableOnUpdate(url)
{
  data = '';

  $( "ul.droptrue" ).each(function() {data = data +'&'+$(this).attr('id')+'='+$(this).sortable("toArray") });

  data = data.slice(1)

  $.ajax({type: "POST",url: url,data: data});
}


function filter_by_selected(t,ft)
{
  selected_values = '';
  
  $( "."+t+"Filters"+ft).each(function() {
    if($(this).attr('checked'))
    {
      selected_values = selected_values+','+$(this).attr('value');
    }
  });
  
  if(selected_values.length>0)
  {
    selected_values = selected_values.substr(1);
    $('#filter_by_'+t).attr('value',selected_values);
    
    $('#filter_by_'+t+'_form').submit();
  }
  else
  {
    alert(I18NText('Please select items'));
  }
}

function addEditorToTextarea(id)
{
  if(!jQuery.browser.mobile)
  {
    if(CKEDITOR)
    {
      CKEDITOR_holders[id] = CKEDITOR.replace(id);

      CKEDITOR_holders[id].on("instanceReady",function() {
        jQuery(window).resize();

        $(".cke_button__maximize").bind('click', function() {
        	$('#modalBox').css('display','block')
        })
      });

    }
    else
    {
      new nicEditor({
      iconsPath:sf_public_path+'js/nicEdit/nicEditorIcons.png',
      buttonList : ['quote','pre','paragraph','bold','italic','underline','strikethrough','left','hr','ol','ul','indent','outdent','forecolor','bgcolor','image','removeformat','xhtml'],
      buttons : {
  		'bold' : {name : I18NText('Bold'), command : 'Bold', tags : ['B','STRONG'], css : {'font-weight' : 'bold'}, key : 'b'},
  		'italic' : {name : I18NText('Italic'), command : 'Italic', tags : ['EM','I'], css : {'font-style' : 'italic'}, key : 'i'},
  		'underline' : {name : I18NText('Underline'), command : 'Underline', tags : ['U'], css : {'text-decoration' : 'underline'}, key : 'u'},
  		'left' : {name : I18NText('Left Align'), command : 'justifyleft', noActive : true},
  		'ol' : {name : I18NText('Numbered List'), command : 'insertorderedlist', tags : ['OL']},
  		'ul' : 	{name : I18NText('Bulleted List'), command : 'insertunorderedlist', tags : ['UL']},
      'indent' : {name : I18NText('Indent More'), command : 'indent', noActive : true},
  		'outdent' : {name : I18NText('Indent Less'), command : 'outdent', noActive : true},
  		'strikethrough' : {name : I18NText('Strike'), command : 'strikeThrough', css : {'text-decoration' : 'line-through'}},
  		'removeformat' : {name : I18NText('Remove Formatting'), command : 'removeformat', noActive : true},
  		'hr' : {name : I18NText('Horizontal Rule'), command : 'insertHorizontalRule', noActive : true},
      'image' : {name : I18NText('Image'), type : 'nicImageButton', tags : ['IMG']},
      'forecolor' : {name : I18NText('Text Color'), type : 'nicEditorColorButton', noClose : true},
  		'bgcolor' : {name : I18NText('Background Color'), type : 'nicEditorBgColorButton', noClose : true},
      'xhtml' : {name : I18NText('Source'), type : 'nicCodeButton'},
      'pre' : {name : I18NText('Code'), type : 'nicPreButton'},
      'quote' : {name : I18NText('Quote'), type : 'nicQuoteButton'},
      'paragraph' : {name : I18NText('Paragraph'), type : 'nicParagraphButton'}
  	}
      }).panelInstance(id);

      $("#"+id+"_nicEditor").bind('paste', function() {
         setTimeout(function() { editor_remove_formatting(id+"_nicEditor"); }, 100);
      });
    }
  }  
}

function editor_remove_formatting(id)
{
  html = $.htmlClean($('#'+id).html().replace(/<div><br><\/div>/g,'<div>&nbsp;</div>'), {format:false,allowedTags:["strong","big","b","i","u","strike","hr","div","br","p","ol","ul","li","blockquote","font","img","pre","table","td","th","tr","h1","h2","h3","h4","h5","h6","sub","sup"]});
  $('#'+id).html(html); 
  
  setCursorEndOfContenteditable(document.getElementById(id))   
}

function check_user_form(form_id,url)
{     
  $('#loading').html('Loading...');
  email = $('#users_email').val();      
      
  $.ajax({type: "POST",url: url,data: {email:email},success: function(data) {  
     
    $('#loading').html('');
      
    if(data==1)
    {        
      $('#email_error').html('<div class="error">'+I18NText('Email already exists')+'<br>'+I18NText('You can\'t create user with email:')+' "'+email+'"'+'</div>');                                    
    }
    else
    {      
      $('#email_error').html('');            
      $('#'+form_id).submit();      
    }                              
  }});          
}

function set_tickets_types_by_departmetn_id(department_id)
{    
  if($('#form_tickets_types_id'))
  {
    default_tickets_types_id = $('#form_tickets_types_id').val(); 
  }
  else
  {
    default_tickets_types_id = $('#default_tickets_types_id').val();
  }

  if(department_id>0)
  {     
    if(departments_tickets_types[department_id])
    {
      if(departments_tickets_types[department_id].length>0)
      {
        types_id_list = departments_tickets_types[department_id].split(',');
        
        tickets_options = document.getElementById('tickets_tickets_types_id');
        tickets_options.options.length = 0;
        
        for(i=0;i<types_id_list.length;i++)
        {
          if(tickets_types_list[types_id_list[i]])
          {          
            tickets_options.options[i] = new Option(tickets_types_list[types_id_list[i]], types_id_list[i]);
            
            if(types_id_list[i]==default_tickets_types_id)
            {
              tickets_options.selectedIndex=i;
            }
          }
        }
                
        set_extra_fields_per_group($('#tickets_tickets_types_id').val());
      }         
    }
    else
    {                               
      tickets_options = document.getElementById('tickets_tickets_types_id');
      tickets_options.options.length = 0;
            
      for(i=0;i<tickets_types_by_sort_order.length;i++)
      {                   
        tickets_options.options[i] = new Option(tickets_types_list[tickets_types_by_sort_order[i]], tickets_types_by_sort_order[i]);
        
        if(tickets_types_by_sort_order[i]==default_tickets_types_id)
        {
          tickets_options.selectedIndex=i;
        }
      }            
            
      set_extra_fields_per_group($('#tickets_tickets_types_id').val());
    }
  }
}

function set_extra_fields_per_group(id)
{  
  if(extra_fields_per_group[id])
  {    
    $( ".extra_field_row" ).each(function() { 
      $(this).css('display','none')
      
      efid = $(this).attr('id').replace('extra_field_row_','')
            
      if($('#extra_fields_'+efid).hasClass('required'))
      {      
        $('#extra_fields_'+efid).removeClass('required').addClass('required_tmp');
      }                
       
    });
    
    if(extra_fields_per_group[id]!='set_off_extra_fields')
    {
      list = extra_fields_per_group[id].split(',');
      
      for(i=0;i<list.length;i++)
      {        
        $('#extra_field_row_'+list[i]).css('display','');        
        
        if($('#extra_fields_'+list[i]).hasClass('required_tmp'))
        {
          $('#extra_fields_'+list[i]).removeClass('required_tmp').addClass('required');
        }
      }       
    } 
  }
  else
  {
    $( ".extra_field_row" ).each(function() { 
      $(this).css('display','')
      
      efid = $(this).attr('id').replace('extra_field_row_','')
      
      if($('#extra_fields_'+efid).hasClass('required_tmp'))
      {
        $('#extra_fields_'+efid).removeClass('required_tmp').addClass('required');
      }
         
    });
  }
  
  jQuery(window).resize();
}

function addAttachment()
{
  $('.attachedFile').clone().appendTo('#attachmentsList').removeClass('attachedFile');
  
  bindDeleteLinkToAttachments();
}

function deleteAttachments(id,url)
{
  if(confirm(I18NText('Are you sure?')))
  {
    $('#attachedFile'+id).fadeOut();
    
    $.ajax({url: url});
  }
  
  return false;
}

function bindDeleteLinkToAttachments()
{
  $('.attachmentBlock .delete_attachment_link').bind('click', function() {           
      p = $(this).parent().parent(); 
      p.fadeOut()
      $('input',p).val('');        
      $('textarea',p).val('');
  });
}

function updateUserRoles(field)
{
  id = field.attr('id').replace('projects_team_','');
  
  if(field.attr('checked'))
  {
   $('#project_roles_'+id).css('display','');
  }
  else
  {
   $('#project_roles_'+id).css('display','none');
   $('#project_roles_'+id).val('');
  }
}

function checkAllInContainer(id)
{
  $("#"+id+" input[type=checkbox]").each(function() { $(this).attr('checked',true)  });
  
  return false;    
}

function hasCheckedInContainer(id)
{
  is_checked = false;
  
  $("#"+id+" input[type=checkbox]").each(function() {     
    if($(this).is(':checked'))
    {    
      is_checked = true;
    }  
  });
  
  
  if(!is_checked)
  {
    alert(I18NText('Please Select Items'));
    return false;
  }
  else
  {
    return true;
  }
  
      
}

function load_form_by_projects_id(container,url,projects_id)
{
  $('#'+container).html(I18NText('Loading...'));
  
  if(projects_id>0)
  {    
    $('#'+container).load(url,{projects_id:projects_id},
      function(response, status, xhr) {
        if (status == "success") {
          jQuery(window).resize();  
        }
      }
    );  
  }
  else
  {
    $('#'+container).html('');
  }
}

function load_form_by_report_type(container,url,report_type)
{
  $('#'+container).html(I18NText('Loading...'));
      
  $('#'+container).load(url,{report_type:report_type},
    function(response, status, xhr) {
      if (status == "success") {
        jQuery(window).resize();  
      }
    }
  );  

}

function userPattern(id,field_id)
{
  name = $('#pattern_name_'+id).val(); 
  desc = $('#pattern_desc_'+id).val();
  
  if(desc.length>0)
  {    
    $('#'+field_id).val($('#'+field_id+'_nicEditor').html()+desc+'<br>')
    $('#'+field_id+'_nicEditor').focus().html($('#'+field_id+'_nicEditor').html()+desc+'<br>');        
  }
  else
  {
    $('#'+field_id).val($('#'+field_id+'_nicEditor').html()+name+'<br>')
    $('#'+field_id+'_nicEditor').focus().html($('#'+field_id+'_nicEditor').html()+name+'<br>');
  }  
    
  setCursorEndOfContenteditable(document.getElementById(field_id+'_nicEditor'))
}

function setCursorEndOfContenteditable(contentEditableElement)
{
    var range,selection;
    if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
    {
        range = document.createRange();//Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection();//get the selection object (allows you to change selection)
        selection.removeAllRanges();//remove any selections already made
        selection.addRange(range);//make the range you have just created the visible selection
    }
    else if(document.selection)//IE 8 and lower
    { 
        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        range.select();//Select the range (make it the visible selection
    }
}

function set_off_extra_fields_list()
{
  if($('#extra_fields_list').css('display')=='none')
  {
    $('#extra_fields_list').css('display','block');    
  }
  else
  {
    $('#extra_fields_list').css('display','none');
  }  
  
}

function expand_dashboard_report(report,url)
{  
  if($('#'+report).css('display')=='block')
  {
    $('#'+report).css('display','none');
    src = $('#'+report+'icon').attr('src').replace('minus_large.png','plus_large.png');
    $('#'+report+'icon').attr('src',src); 
    
    $.ajax({type: "POST",url: url,data: {report:report,type:'hide'}});   
  }
  else
  {
    $('#'+report).css('display','block');
    src = $('#'+report+'icon').attr('src').replace('plus_large.png','minus_large.png');
    $('#'+report+'icon').attr('src',src);
    $.ajax({type: "POST",url: url,data: {report:report,type:'show'}});
  }
}

function check_event_repeat_type(type)
{
  if(type=='weekly')
  {
    $('#events_repeat_days_tr').css('display','');
  }
  else
  {
    $('#events_repeat_days_tr').css('display','none');
  }
}

function time_report_export(form_id, type)
{
  $('#format','#'+form_id).val(type); 
  $('#'+form_id).submit(); 
  return false;
}

function removeRelated(hide_id,url)
{
  if(confirm(I18NText('Ary you sure?')))
  {
    $('#'+hide_id).fadeOut();
    
    $.ajax({type: "POST",url: url});
  }
}

function copyToRelated(form_name,type,url_copy, url_preview)
{
  if(type=='name')
  {       
    $('#'+form_name+'_name').val($('#item_name').val());  
  }
  
  if(type=='description')
  {           
    field_id =form_name+'_description'; 
    $('#'+field_id).val($('#'+field_id+'_nicEditor').html()+$('#item_description').val()+'<br>')
    $('#'+field_id+'_nicEditor').focus().html($('#'+field_id+'_nicEditor').html()+$('#item_description').val()+'<br>');   
  }
  
  if(type=='attachments')
  { 
    $.ajax({type: "POST",
      url: url_copy,
      data: {attachments:$('#item_attachments').val()},
      success: function(data) { 
        $("#attachmentsList").load(url_preview);
      } 
    });
  }
}

function show_original_text(id,v)
{
  $(id).val(v);
  
  if($(id+'_nicEditor'))
  {
    $(id+'_nicEditor').html(v);
  }
}

function SelectTextInElement(element) 
{
  var doc = document;
  var text = document.getElementById(element);
  
   if (doc.body.createTextRange) { // ms
      var range = doc.body.createTextRange();
      range.moveToElementText(text);
      range.select();
  } else if (window.getSelection) { // moz, opera, webkit
      var selection = window.getSelection();            
      var range = doc.createRange();
      range.selectNodeContents(text);
      selection.removeAllRanges();
      selection.addRange(range);
  }
}



