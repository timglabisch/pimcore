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

require __DIR__.'/../pimcore/config/startup_tests.php';

# for debugging uncomment:
# while(@ob_end_flush());


class Webservice_JsonEncoder {

    public function encode($data,$returnData = false) {
        $data = Zend_Json::encode($data, null, array());

        if($returnData){
            return $data;
        }else{
            $response = Zend_Controller_Front::getInstance()->getResponse();
            $response->setHeader('Content-Type', 'application/json', true);
            $response->setBody($data);

            #$response->sendResponse();

            /* todo do not use exit */
            throw new Pimcore_Test_Exception_AvoidExit($response);
            exit;
        }
    }

    public function decode($data){
        $data = Zend_Json::decode($data);
        return $data;
    }
}

# bootstrap a sandboxed pimcore.
Pimcore_Test_Pimcore::run();
