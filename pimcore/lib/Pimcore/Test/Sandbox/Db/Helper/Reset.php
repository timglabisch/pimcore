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


class Pimcore_Test_Sandbox_Db_Helper_Reset extends \mysqli {

    public function __construct($config) {

        $this->configToReset = $config;
        $this->reset();
    }



    public function reset() {
        $db = new mysqli($this->configToReset["host"], $this->configToReset["username"], $this->configToReset["password"], null, (int)$this->configToReset["port"]);
        assert($db->query("SET NAMES utf8"));

        assert($db->query("DROP database IF EXISTS " . $this->configToReset["dbname"] . ";"));
        assert($db->query("CREATE DATABASE " . $this->configToReset["dbname"] . " charset=utf8"));
        assert($db->query("USE " . $this->configToReset["dbname"]));

        if(!defined(PIMCORE_TEST_SQL) && !PIMCORE_TEST_SQL)
            $this->copyTables($db);
        else {
            if ($db->multi_query(file_get_contents(PIMCORE_TEST_SQL)))
                while ($db->next_result());
        }

        $db->close();
    }

    /**
     * @param $db
     */
    public function copyTables($db) {
        $statementTablesToCopy = $db->query('
            SELECT TABLES.TABLE_NAME, TABLES.TABLE_TYPE, REPLACE(VIEWS.VIEW_DEFINITION, "`' . $this->configToReset['orig_dbname'] . '`.", "") AS VIEW_DEFINITION FROM
            INFORMATION_SCHEMA.TABLES
            LEFT JOIN INFORMATION_SCHEMA.VIEWS USING (TABLE_SCHEMA, TABLE_NAME)
            WHERE
            TABLE_SCHEMA = "' . $this->configToReset['orig_dbname'] . '"
            AND TABLE_TYPE IN ("BASE TABLE", "VIEW")
        ');

        while ($tablesToCopy = $statementTablesToCopy->fetch_array()) {
            assert($db->query($q = 'CREATE TABLE `' . $this->configToReset["dbname"] . '`.`' . $tablesToCopy["TABLE_NAME"] . '` LIKE `' . $this->configToReset["orig_dbname"] . '`.`' . $tablesToCopy["TABLE_NAME"] . '`'));
            assert($db->query($q = 'INSERT `' . $this->configToReset["dbname"] . '`.`' . $tablesToCopy["TABLE_NAME"] . '` SELECT * FROM `' . $this->configToReset["orig_dbname"] . '`.`' . $tablesToCopy["TABLE_NAME"] . '`'));
        }
    }

}