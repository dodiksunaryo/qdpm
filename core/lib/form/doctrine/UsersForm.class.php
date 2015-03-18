<?php

/**
 * Users form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsersForm extends BaseUsersForm
{
  public function configure()
  {        
    $this->widgetSchema['users_group_id'] = new sfWidgetFormChoice(array('choices'=>UsersGroups::getChoicesByType()),array('onChange'=>'set_extra_fields_per_group(this.value)'));
      
    $this->widgetSchema['active'] = new sfWidgetFormInputCheckbox(array(),array('value'=>1));
    $this->setDefault('active', 1);
            
    $this->widgetSchema['notify'] = new sfWidgetFormInputCheckbox(array(),array('value'=>1));
    $this->setDefault('notify', 1);
    $this->setValidator('notify',new sfValidatorString(array('required' => false)));
    
    $this->widgetSchema['remove_photo'] = new sfWidgetFormInputCheckbox(array(),array('value'=>1));
    $this->setDefault('remove_photo', 0);
    $this->setValidator('remove_photo',new sfValidatorString(array('required' => false)));
          
    $this->widgetSchema['photo'] = new sfWidgetFormInputFile();
    $this->widgetSchema['photo_preview'] = new sfWidgetFormInputHidden();
    $this->setValidator('photo_preview',new sfValidatorString(array('required' => false)));
    
    $this->widgetSchema['name']->setAttributes(array('size'=>'40','class'=>'required'));
    $this->widgetSchema['email']->setAttributes(array('size'=>'40','class'=>'required'));
    
    if($this->getObject()->isNew())
    {
      $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
      $this->widgetSchema['password']->setAttributes(array('class'=>'required'));      
    }
    else
    {
      unset($this->widgetSchema['password']);
      unset($this->validatorSchema['password']);
      
      $this->widgetSchema['new_password'] = new sfWidgetFormInputPassword();
      $this->setValidator('new_password',new sfValidatorString(array('required' => false)));
      
      $this->setDefault('photo_preview',$this->getObject()->getPhoto());
    }
        
    $this->widgetSchema['culture'] = new sfWidgetFormI18nChoiceLanguage(array('languages'=>app::getLanguageCodes()));    
    $this->setDefault('culture',sfConfig::get('sf_default_culture'));
         
    
    $this->widgetSchema->setLabels(array('users_group_id'=>'Group',
                                         'name'=>'Full Name',
                                         'remove_photo'=>'Remove Photo',
                                         'new_password'=>'New Password',
                                         'culture'=>'Language',
                                         'default_home_page'=>'Start Page',
                                         'active'=>'Active?',
                                         'notify'=>'send login details to user'));
                                         
    unset($this->widgetSchema['skin']);
    unset($this->validatorSchema['skin']);
    
  }
}
