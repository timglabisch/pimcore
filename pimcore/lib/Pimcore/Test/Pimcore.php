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

        $config = new Zend_Config_Xml(PIMCORE_TEST_CONFIGURATION_SYSTEM, null, true);
        $config->general->debug = 1;
        $config->database->params->adapterNamespace = 'Pimcore_Test_Sandbox_Db_Adapter';

        if(isset($_SERVER['PIMCORE_TEST_DRIVER']) && $_SERVER['PIMCORE_TEST_DRIVER'])
            $config->database->adapter = $_SERVER['PIMCORE_TEST_DRIVER'];

        Pimcore_Config::setSystemConfig($config);

        parent::run();
    }

    public static function dispatch($front, $debug = false) {
        # we dont want Pimcore to Dispatch for now.
    }

    public static function isFrontend() {
        return false;
    }

    public static function shouldThrowExceptions() {
        return true;
    }

    public static function getControllerFront() {
        $front = parent::getControllerFront();
        $front->setDispatcher(new Pimcore_Test_Controller_Dispatcher_Standard());
        return $front;
    }

    public static function testDispatch($request) {
        if(is_string($request)) {
            $r = new Zend_Controller_Request_HttpTestCase();
            $r->setRequestUri($request);
            return static::testDispatchRequest($r);
        }

        if($request instanceof Zend_Controller_Request_HttpTestCase) {
            return static::testDispatchRequest($request);
        }

        throw new \Exception('bad Argument, string or Zend_Controller_Request_HttpTestCase required');
    }

    public static function testDispatchRequest($request) {
        $front = Pimcore::getControllerFront();

        $response = new Zend_Controller_Response_HttpTestCase();

        $front->throwExceptions(true);

        try {
            $front->dispatch($request, $response);
        } catch(Pimcore_Test_Exception_AvoidExit $e) {
            try {
                # will break some tests ...
                # Pimcore_Resource_Mysql::getConnection()->commit();
            } catch(\Exception $ie) {
                $a = $ie;
            }
            return $e->getResponse();
        }

        foreach($response->getException() as $exception) {
            if($exception instanceof Pimcore_Test_Exception_AvoidExit) {
                return $exception->getResponse();
            }
        }

        return $response;
    }

}