<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    
 
    $this->categories = JobeetCategoryPeer::getWithJobs();
    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->JobeetJob = $this->getRoute()->getObject();
    $this->getUser()->addJobToHistory($this->JobeetJob);
    
  }

  public function executeNew(sfWebRequest $request)
  {
    $job = new JobeetJob();
    $job->setType('full-time');
   
    $this->form = new JobeetJobForm($job);
  }

  public function executeCreate(sfWebRequest $request)
  {

    $this->form = new JobeetJobForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $job = $this->getRoute()->getObject();
  $this->forward404If($job->getIsActivated());
 
  $this->form = new JobeetJobForm($job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new JobeetJobForm($this->getRoute()->getObject());
  $this->processForm($request, $this->form);
  $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
 
  $job = $this->getRoute()->getObject();
  $job->delete();
 
  $this->redirect('job/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $JobeetJob = $form->save();

      $this->redirect('job_show', $job);
    }
  }

  public function executePublish(sfWebRequest $request)
{
  $request->checkCSRFProtection();
 
  $job = $this->getRoute()->getObject();
  $job->publish();
 
  $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));
 
  $this->redirect('job_show_user', $job);
}

public function executeExtend(sfWebRequest $request)
{
  $request->checkCSRFProtection();
 
  $job = $this->getRoute()->getObject();
  $this->forward404Unless($job->extend());
 
  $this->getUser()->setFlash('notice', sprintf('Your job validity has been extended until %s.', $job->getExpiresAt('m/d/Y')));
 
  $this->redirect('job_show_user', $job);
}
}
