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

class Pimcore_Test_Sandbox_Db_Adapter_Mysqli extends \Zend_Db_Adapter_Mysqli {

    protected $configToReset = null;

    public function __construct($config) {

        $config['orig_dbname'] = $config["dbname"];
        $config["dbname"] = 'unittests_' . $config["dbname"];

        $this->resetHelper = new Pimcore_Test_Sandbox_Db_Helper_Reset($config);
        $this->resetHelper->reset();

        parent::__construct($config);
    }



    public function reset() {
        $this->resetHelper->reset();
    }

    /**
     * @param $db
     */
    public function copyTables($db) {
        $this->resetHelper->copyTables($db);
    }
}