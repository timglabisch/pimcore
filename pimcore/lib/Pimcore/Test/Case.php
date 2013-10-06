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
            Zend_Registry::setInstance(clone static::$copyOfZendRegistry);
        }


        Pimcore_Model_Cache::clearAll();

        Pimcore_Resource::get()->reset();

        $filesystemSandbox = new Pimcore_Test_Sandbox_Filesystem();
        $filesystemSandbox->reset();
    }

    function dispatch($request) {
        if(is_string($request)) {
            $r = new Zend_Controller_Request_HttpTestCase();
            $r->setRequestUri($request);
            return $this->dispatchRequest($r);
        }

        if($request instanceof Zend_Controller_Request_HttpTestCase) {
            return $this->dispatchRequest($request);
        }

        throw new \Exception('bad Argument, string or Zend_Controller_Request_HttpTestCase required');
    }

    function dispatchRequest($request) {
        $front = Pimcore::getControllerFront();

        $response = new Zend_Controller_Response_HttpTestCase();
        $front->dispatch($request, $response);
        $front->resetInstance();
        return $response;
    }

}