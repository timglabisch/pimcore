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

class Pimcore_Test_Case extends \PHPUnit_Framework_TestCase {

    protected static $copyOfZendRegistry;

    function setUp() {

        if(!static::$copyOfZendRegistry) {
            static::$copyOfZendRegistry = clone Zend_Registry::getInstance();
        } else {
            Zend_Registry::_unsetInstance();
            Zend_Registry::setInstance(static::$copyOfZendRegistry);
        }


        Pimcore_Model_Cache::clearAll();

        Pimcore_Resource::get()->reset();

        $filesystemSandbox = new Pimcore_Test_Sandbox_Filesystem();
        $filesystemSandbox->reset();


    }

}