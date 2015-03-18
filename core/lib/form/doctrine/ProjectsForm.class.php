<?php

/**
 * Projects form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProjectsForm extends BaseProjectsForm
{
  public function configure()
  {        
    $this->widgetSchema['projects_types_id'] = new sfWidgetFormChoice(array('choices'=>app::getItemsChoicesByTable('ProjectsTypes')));
    $this->setDefault('projects_types_id', app::getDefaultValueByTable('ProjectsTypes'));
            
    $this->widgetSchema['projects_status_id'] = new sfWidgetFormChoice(array('choices'=>app::getItemsChoicesByTable('ProjectsStatus')));
    $this->setDefault('projects_status_id', app::getDefaultValueByTable('ProjectsStatus'));
        
    $this->widgetSchema['name']->setAttributes(array('size'=>'60','class'=>'required'));
    $this->widgetSchema['description']->setAttributes(array('class'=>'editor'));
          
    $this->widgetSchema['created_by'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->setDefault('created_at', date('Y-m-d H:i:s'));
    
    $this->widgetSchema->setLabels(array('projects_types_id'=>'Type',                                         
                                         'projects_status_id'=>'Status'));

  }
}

