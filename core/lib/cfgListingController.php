<?php

class cfgListingController
{
  public $module;
  
  public function __construct($module,$url_params = '')
	{
	 $this->module = $module;
	 $this->url_params = $url_params;
	}
	
	public function add_url_params($d)
	{
    if(strlen($this->url_params)>0)
    {
      return $d . $this->url_params; 
    }
    else
    {
      return '';
    }    
  }
	
	public function insert_button($title = false)
	{
	  if(!$title)
	  {
      $title = __('Add');
    }
    
	  $f = new sfWidgetFormInput();
	  $attributes = array('type'=>'button', 'class'=>'btn','onClick'=>'openModalBox(\'' . url_for($this->module . '/new' . $this->add_url_params('?'),true) . '\')');
    return $f->render('',$title,$attributes);
  }
  
  public function sort_button()
	{
	  $f = new sfWidgetFormInput();
	  $attributes = array('type'=>'button', 'class'=>'btn','onClick'=>'openModalBox(\'' . url_for('app/sortItems?t=' . $this->module . $this->add_url_params('&') ,true) . '\')');
    return $f->render('',__('Sort'),$attributes);
  }
  
  public function edit_button($id)
	{
	  $f = new sfWidgetFormInput();
	  $attributes = array('type'=>'image','title'=>__('Edit'),'class'=>'actionIcon iconEdit','src'=>public_path('images/icons/edit.png',true),'onClick'=>'openModalBox(\'' . url_for($this->module . '/edit?id=' . $id . $this->add_url_params('&'),true) . '\')');
    return $f->render('',__('Edit'),$attributes);
  }
        
  public function delete_button($id)
	{
    return link_to(image_tag(public_path('images/icons/delete.png',true),array('title'=>__('Delete'),'class'=>'iconDelete')), $this->module  . '/delete?id='  . $id  . $this->add_url_params('&'), array('method' => 'delete','class'=>'actionIcon', 'confirm' => __('Are you sure?')));
  }
  
  public function delete_mbutton($id)
	{
    return link_to_modalbox(image_tag(public_path('images/icons/delete.png',true),array('title'=>__('Delete'))),$this->module  . '/delete?id='  . $id  . $this->add_url_params('&'));
  }
  
  public function action_buttons($id)
  {
    return $this->delete_button($id)  .  $this->edit_button($id);
  }
} 