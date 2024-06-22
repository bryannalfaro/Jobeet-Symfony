<?php

require_once dirname(__FILE__).'/../vendor/symfony/symfony1/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array('sfPropelPlugin', 'sfGuardPlugin'));
  }
}
