<?php

/**
 * scheduler actions.
 *
 * @package    sf_sandbox
 * @subpackage scheduler
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class schedulerActions extends sfActions
{
  public function checkAccess($users_id,$access='')
  {
    if($users_id>0)
    {
      if(!$this->getUser()->hasCredential('allow_manage_personal_scheduler')  or $users_id!=$this->getUser()->getAttribute('id'))
      {
        $this->redirect('accessForbidden/index');
      }
    }
    else
    {
      if(($access=='manage' and !$this->getUser()->hasCredential('public_scheduler_access_full_access')) or ($access=='view' and !$this->getUser()->hasCredential('public_scheduler_access_full_access') and !$this->getUser()->hasCredential('public_scheduler_access_view_only')))
      {
        $this->redirect('accessForbidden/index');
      }
    }
  
  }
    
  public function executePersonal(sfWebRequest $request)
  {
    $this->checkAccess($this->getUser()->getAttribute('id'),'view');
    
    if(!$this->getUser()->hasAttribute('personal_scheduler_current_time'))
    {    
      $this->getUser()->setAttribute('personal_scheduler_current_time',time());
    }
    
    if($request->hasParameter('month'))
    {
      $this->changeMonth($request->getParameter('month'),'personal_scheduler_current_time');
      $this->redirect('scheduler/personal');
    }
    
    app::setPageTitle('Personal Scheduler',$this->getResponse());
    
  }
  
  protected function changeMonth($month,$scheduler_time)
  {
    switch($month)
    {
      case 'next_month': $this->getUser()->setAttribute($scheduler_time,strtotime("+1 month",$this->getUser()->getAttribute($scheduler_time)));
        break;
      case 'prev_month': $this->getUser()->setAttribute($scheduler_time,strtotime("-1 month",$this->getUser()->getAttribute($scheduler_time)));
        break;  
      case 'current_month': $this->getUser()->setAttribute($scheduler_time,time());  
        break;   
    }
  }
  
  public function executeInfo(sfWebRequest $request)
  {
    $this->forward404Unless($this->events = Doctrine_Core::getTable('Events')->find(array($request->getParameter('id'))), sprintf('Object events does not exist (%s).', $request->getParameter('id')));
    
    $this->checkAccess($this->events->getUsersId(),'view');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EventsForm();
    
    $this->checkAccess($request->getParameter('users_id'),'manage');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->checkAccess($request->getParameter('users_id'),'manage');

    $this->form = new EventsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($events = Doctrine_Core::getTable('Events')->find(array($request->getParameter('id'))), sprintf('Object events does not exist (%s).', $request->getParameter('id')));
    
    $this->checkAccess($events->getUsersId(),'manage');
    
    $this->form = new EventsForm($events);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($events = Doctrine_Core::getTable('Events')->find(array($request->getParameter('id'))), sprintf('Object events does not exist (%s).', $request->getParameter('id')));
    
    $this->checkAccess($events->getUsersId(),'manage');
    
    $this->form = new EventsForm($events);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {    
    $this->forward404Unless($events = Doctrine_Core::getTable('Events')->find(array($request->getParameter('id'))), sprintf('Object events does not exist (%s).', $request->getParameter('id')));
    
    $this->checkAccess($request->getParameter('users_id'),'manage');
    
    Attachments::deleteAttachmentsByBindId($events->getEventId(),'events');
    ExtraFieldsList::deleteFieldsByBindId($events->getEventId(),'events');
    
    $events->delete();


    if($request->getParameter('users_id')>0)
    {
      $this->redirect('scheduler/personal');
    }
    else
    {
      $this->redirect('scheduler/index');
    }
    
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {            
      $events = $form->save();
      
      ExtraFieldsList::setValues($request->getParameter('extra_fields'),$events->getEventId(),'events',$this->getUser());
            
      Attachments::insertAttachments($request->getFiles(),'events',$events->getEventId(),$request->getParameter('attachments_info'),$this->getUser());
      
      if($events->getUsersId()>0)
      {
        $this->redirect('scheduler/personal');        
      }
      else
      {
        $this->redirect('scheduler/index');  
      }    
    }
  }
}
                                       