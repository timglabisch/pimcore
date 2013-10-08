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
    protected static $copyOfRouter;
    protected static $user = null;
    protected static $restclient = null;

    function setUp() {

        if(!static::$copyOfZendRegistry) {
            static::$copyOfZendRegistry = clone Zend_Registry::getInstance();
        } else {
            Zend_Registry::_unsetInstance();
            Zend_Registry::setInstance(clone static::$copyOfZendRegistry);
        }


        if(!static::$copyOfRouter) {
            static::$copyOfRouter = serialize(Zend_Controller_Front::getInstance()->getRouter());
        } else {
            Zend_Controller_Front::getInstance()->setRouter(unserialize(static::$copyOfRouter));
        }



        Pimcore_Model_Cache::clearAll();

        Pimcore_Resource::get()->reset();

        $filesystemSandbox = new Pimcore_Test_Sandbox_Filesystem();
        $filesystemSandbox->reset();


        static::$user = null;
        static::$restclient = null;
    }

    function createAdminUser() {

        if(static::$user)
            return static::$user;

        $user = new User();
        $user->setAdmin(true);
        $user->setFirstname('Unittest');
        $user->setLastname('Unittest');
        $user->setPassword('APIKEY');
        $user->save();

        return static::$user = $user;
    }

    /**
     * @return Pimcore_Test_Tool_RestClient
     */
    function getRestclient() {

        if(static::$restclient)
            return static::$restclient;

        $restclient = new Pimcore_Test_Tool_RestClient();
        $restclient->setApiKey($this->createAdminUser()->getApiKey());
        return static::$restclient = $restclient;
    }

    /**
     * @param $request
     * @return Zend_Controller_Response_HttpTestCase
     */
    function dispatch($request) {
        return Pimcore_Test_Pimcore::testDispatch($request);
    }

}