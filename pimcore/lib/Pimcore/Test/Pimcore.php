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
 * @copyright  Copyright (c) 2009-2013 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Pimcore_Test_Pimcore extends Pimcore {

    /**
     * @return Pimcore_Test_Sandbox_Filesystem
     */
    public static function getSandboxFilesystem() {
        return new Pimcore_Test_Sandbox_Filesystem();
    }

    public static function run() {

        static::getSandboxFilesystem()->reset();

        $config = new Zend_Config_Xml(PIMCORE_CONFIGURATION_SYSTEM, null, true);
        $config->general->debug = 1;
        $config->database->params->adapterNamespace = 'Pimcore_Test_Sandbox_Db_Adapter';
        Pimcore_Config::setSystemConfig($config);

        parent::run();
    }

    public static function dispatch($front, $debug = false) {
        # we dont want Pimcore to Dispatch for now.
    }

    public static function shouldThrowExceptions() {
        return true;
    }

}