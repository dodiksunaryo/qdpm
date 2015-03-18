<?php

require_once(dirname(__FILE__).'/check.php');

require_once(dirname(__FILE__).'/core/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('qdPM', 'prod', true);
sfContext::createInstance($configuration)->dispatch();
