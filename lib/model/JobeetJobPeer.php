<?php


/**
 * Skeleton subclass for performing query and update operations on the 'jobeet_job' table.
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
class JobeetJobPeer extends BaseJobeetJobPeer {

  static public $types = array(
    'full-time' => 'Full time',
    'part-time' => 'Part time',
    'freelance' => 'Freelance',
  );

  static public function getActiveJobs(Criteria $criteria = null)
  {
    return self::doSelect(self::addActiveJobsCriteria($criteria));
  }
 
  static public function countActiveJobs(Criteria $criteria = null)
  {
    return self::doCount(self::addActiveJobsCriteria($criteria));
  }
 
  static public function addActiveJobsCriteria(Criteria $criteria = null)
  {
    if (is_null($criteria))
    {
      $criteria = new Criteria();
    }
 
    $criteria->add(self::EXPIRES_AT, time(), Criteria::GREATER_THAN);
    $criteria->addDescendingOrderByColumn(self::CREATED_AT);

    $criteria->add(self::IS_ACTIVATED, true);
 
    return $criteria;
  }
 
  static public function doSelectActive(Criteria $criteria)
  {
    return self::doSelectOne(self::addActiveJobsCriteria($criteria));
  }

  static public function cleanup($days)
{
  $criteria = new Criteria();
  $criteria->add(self::IS_ACTIVATED, false);
  $criteria->add(self::CREATED_AT, time() - 86400 * $days, Criteria::LESS_THAN);
 
  return self::doDelete($criteria);
}

} // JobeetJobPeer
