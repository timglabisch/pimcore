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

class Pimcore_Test_Sandbox_Db_Adapter_Pdo_Mysql extends \Zend_Db_Adapter_Pdo_Mysql {

    protected $configToReset = null;

    public function __construct($config) {

        $config['orig_dbname'] = $config["dbname"];
        $config["dbname"] = 'unittests_' . $config["dbname"];

        $this->configToReset = $config;

        $this->reset();

        parent::__construct($config);
    }


    public function reset() {
        $db = new mysqli($this->configToReset["host"], $this->configToReset["username"], $this->configToReset["password"], null, (int)$this->configToReset["port"]);
        $db->query("SET NAMES utf8");

        $db->query("DROP database IF EXISTS " . $this->configToReset["dbname"] . ";");
        $db->query("CREATE DATABASE " . $this->configToReset["dbname"] . " charset=utf8");

        $statementTablesToCopy = $db->query('
            SELECT TABLES.TABLE_NAME, TABLES.TABLE_TYPE, REPLACE(VIEWS.VIEW_DEFINITION, "`' . $this->configToReset['orig_dbname'] . '`.", "") AS VIEW_DEFINITION FROM
            INFORMATION_SCHEMA.TABLES
            LEFT JOIN INFORMATION_SCHEMA.VIEWS USING (TABLE_SCHEMA, TABLE_NAME)
            WHERE
            TABLE_SCHEMA = "' . $this->configToReset['orig_dbname'] . '"
            AND TABLE_TYPE IN ("BASE TABLE", "VIEW")
        ');

        while ($tablesToCopy = $statementTablesToCopy->fetch_array()) {
            $db->query($q = 'CREATE TABLE `' . $this->configToReset["dbname"] . '`.`' . $tablesToCopy["TABLE_NAME"] . '` SELECT * FROM `' . $this->configToReset["orig_dbname"] . '`.`' . $tablesToCopy["TABLE_NAME"] . '`'); // LIMIT 0');
        }

        $db->close();
    }
}