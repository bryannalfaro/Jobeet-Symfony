<?php


/**
 * Skeleton subclass for representing a row from the 'jobeet_category' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jun 17 10:56:39 2024
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class JobeetCategory extends BaseJobeetCategory {

    public function __toString()
  {
    return $this->getName();
  }

  public function setName($name)
{
  parent::setName($name);
 
  $this->setSlug(Jobeet::slugify($name));
}

  public function getActiveJobs($max = 10)
{
  $criteria = $this->getActiveJobsCriteria();
  $criteria->setLimit($max);
 
  return JobeetJobPeer::getActiveJobs($criteria);
}

// public function getSlug()
// {
//   return Jobeet::slugify($this->getName());
// }

public function countActiveJobs()
{
  $criteria = $this->getActiveJobsCriteria();
 
  return JobeetJobPeer::countActiveJobs($criteria);
}

public function getActiveJobsCriteria()
{
  $criteria = new Criteria();
  $criteria->add(JobeetJobPeer::CATEGORY_ID, $this->getId());
 
  return JobeetJobPeer::addActiveJobsCriteria($criteria);
}

} // JobeetCategory
