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

class Pimcore_Test_Tool_RestClient extends Pimcore_Tool_RestClient {

    protected $dispatcher;

    protected function doRequest($uri, $method = "GET", $body = null) {

        $uri =  '/webservice/rest/' . $uri;

        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setMethod($method);
        $request->setRequestUri($uri);

        /**
         * todo: just put and post?!
         */
        if ($body != null && ($method == "PUT" || $method == "POST")) {
            $request->setRawBody($body);
        }

        $res = Pimcore_Test_Pimcore::testDispatch($request);

        return json_decode($res->getBody());
    }

}