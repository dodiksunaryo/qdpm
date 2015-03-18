<?php

/**
 * Versions form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VersionsForm extends BaseVersionsForm
{
  public function configure()
  {
    $this->widgetSchema['versions_status_id'] = new sfWidgetFormChoice(array('choices'=>app::getItemsChoicesByTable('VersionsStatus')));
    $this->setDefault('versions_status_id', app::getDefaultValueByTable('VersionsStatus'));
    
    $this->widgetSchema['projects_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['due_date'] = new sfWidgetFormInput(array(),array('class'=>'datepicker'));
    $this->widgetSchema['description']->setAttributes(array('class'=>'editor'));
    $this->widgetSchema['name']->setAttributes(array('class'=>'required'));
    
    $this->widgetSchema->setLabels(array('versions_status_id'=>'Status','due_date'=>'Due Date'));
  }
}
