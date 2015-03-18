<?php

/**
 * ExtraFields form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ExtraFieldsForm extends BaseExtraFieldsForm
{
  public function configure()
  {
    $this->widgetSchema['active'] = new sfWidgetFormInputCheckbox(array(),array('value'=>1));
    $this->setDefault('active',1);
    
    $this->widgetSchema['display_in_list'] = new sfWidgetFormInputCheckbox(array(),array('value'=>1));
    $this->setDefault('display_in_list',0);        
        
    $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices'=>ExtraFields::getTypesChoices()));
                                
    $this->widgetSchema['bind_type'] = new sfWidgetFormInputHidden();
    
    $this->widgetSchema['name']->setAttribute('class','required');
    $this->widgetSchema['sort_order']->setAttribute('size','3');    

    $this->widgetSchema->setLabels(array('display_in_list'=>'Display in Listing?',
                                         'sort_order'=>'Sort Order',                                                                                  
                                         'active'=>'Active?',                                                                                  
                                         ));
  
  }
}
