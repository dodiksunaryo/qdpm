<?php

/**
 * UserReports form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserReportsForm extends BaseUserReportsForm
{
  public function configure()
  {
    $this->widgetSchema['display_on_home'] = new sfWidgetFormInputCheckbox(array(),array('value'=>1));
    $this->setDefault('display_on_home', 0);  
        
    $this->widgetSchema['due_date_from'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    $this->widgetSchema['due_date_to'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    
    $this->widgetSchema['created_from'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    $this->widgetSchema['created_to'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    
    $this->widgetSchema['closed_from'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    $this->widgetSchema['closed_to'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    
    $this->widgetSchema['users_id'] = new sfWidgetFormInputHidden();
    
    $this->widgetSchema['name']->setAttributes(array('size'=>'40','class'=>'required'));
              
    $this->widgetSchema->setLabels(array('display_on_home'=>'Dislay on dashboard'));
      
    unset($this->widgetSchema['sort_order']);
    unset($this->validatorSchema['sort_order']);
  }
}
