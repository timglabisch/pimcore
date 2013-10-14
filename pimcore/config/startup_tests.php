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

// some general pimcore definition overwrites
if(!defined("PIMCORE_ADMIN")) define("PIMCORE_ADMIN", true);
if(!defined("PIMCORE_DEBUG")) define("PIMCORE_DEBUG", true);
if(!defined("PIMCORE_DEVMODE")) define("PIMCORE_DEVMODE", true);
if(!defined("TESTS_PATH")) define("TESTS_PATH", sys_get_temp_dir() .'/pimcore_unittests/');
if(!defined("TESTS_ORIG_WEBSITE_VAR")) define("TESTS_ORIG_WEBSITE_VAR", __DIR__.'/../../website/var');
if(!defined("PIMCORE_WEBSITE_VAR")) define("PIMCORE_WEBSITE_VAR",  TESTS_PATH.'/website/var');

// Test Configuration
if(!defined("PIMCORE_TEST")) define("PIMCORE_TEST", true);
if(!defined("PIMCORE_TEST_CONFIGURATION_SYSTEM")) define("PIMCORE_TEST_CONFIGURATION_SYSTEM", TESTS_ORIG_WEBSITE_VAR.'/config/system.xml');
if(!defined("PIMCORE_TEST_SQL")) define("PIMCORE_TEST_SQL", false);

require __DIR__.'/startup.php';