<?php
/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */
include_once("pimcore/config/startup.php");

//todo: this config should be editable by the user, by merging an own configuration with this.
$config = require 'pimcore/config/config.php';

$serviceManager = new Pimcore_Service_Manager(
    new Zend\ServiceManager\Config($config['service_manager'])
);

try {
    $serviceManager->getPimcore()->run();

} catch (Exception $e) {
    // handle exceptions, log to file
    if(class_exists("Logger")) {
        $serviceManager->getLogger()->emerg($e);
    }
   	throw $e;
}
