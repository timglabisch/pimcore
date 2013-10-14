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

if(!defined("PIMCORE_FRONTEND_MODULE")) define("PIMCORE_FRONTEND_MODULE", 'website_demo');
if(!defined("TESTS_ORIG_WEBSITE_VAR")) define('TESTS_ORIG_WEBSITE_VAR', __DIR__.'/../website_example/var');
if(!defined("PIMCORE_TEST_SQL")) define("PIMCORE_TEST_SQL", __DIR__.'/../pimcore/modules/install/mysql/install.sql');
if(!defined("PIMCORE_TEST_CONFIGURATION_SYSTEM")) define("PIMCORE_TEST_CONFIGURATION_SYSTEM", __DIR__.'/config/travisci/system.xml');

require __DIR__.'/../pimcore/config/startup_tests.php';

# for debugging uncomment:
# while(@ob_end_flush());

# bootstrap a sandboxed pimcore.
Pimcore_Test_Pimcore::run();
