<?php

/**
 * Tickets form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TicketsForm extends BaseTicketsForm
{
  public function configure()
  {
    $projects = $this->getOption('projects');
    $sf_user = $this->getOption('sf_user');
    
      
    $this->widgetSchema['departments_id'] = new sfWidgetFormChoice(array('choices'=>app::getItemsChoicesByTable('Departments')),array('class'=>'required'));
    
    $this->widgetSchema['tickets_status_id'] = new sfWidgetFormChoice(array('choices'=>app::getItemsChoicesByTable('TicketsStatus')));
    $this->setDefault('tickets_status_id', app::getDefaultValueByTable('TicketsStatus'));
    
    $this->widgetSchema['tickets_types_id'] = new sfWidgetFormChoice(array('choices'=>app::getItemsChoicesByTable('TicketsTypes')));
    $this->setDefault('tickets_types_id', app::getDefaultValueByTable('TicketsTypes'));
    
    
    if($projects)
    {
      if(Users::hasAccess('edit','projects',$sf_user,$projects->getId()))
      {
        $this->widgetSchema['users_id'] = new sfWidgetFormChoice(array('choices'=>Users::getChoices(array_merge(array($sf_user->getAttribute('id')),array_filter(explode(',',$projects->getTeam()))),'tickets_insert')));
      }
      else
      {
        $this->widgetSchema['users_id'] = new sfWidgetFormInputHidden();
      }
    }
    
    $this->widgetSchema['name']->setAttributes(array('size'=>'60','class'=>'required'));
    $this->widgetSchema['description']->setAttributes(array('class'=>'editor'));
    
    $this->widgetSchema['projects_id'] = new sfWidgetFormInputHidden();               
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->setDefault('created_at', date('Y-m-d H:i:s'));
    
    
    $this->widgetSchema->setLabels(array(
                                         'tickets_types_id'=>'Type',                                                                                                                                                                    
                                         'tickets_status_id'=>'Status',
                                         'departments_id'=>'Department',
                                         'name'=>'Subject',
                                         'users_id'=>'Created By',                                        
                                         ));
        
  }
}
