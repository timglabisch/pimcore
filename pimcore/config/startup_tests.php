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
define("PIMCORE_TEST", true);
define("PIMCORE_ADMIN", true);
define("PIMCORE_DEBUG", true);
define("PIMCORE_DEVMODE", true);
define("TESTS_PATH", sys_get_temp_dir() .'/pimcore_unittests/');
define("TESTS_ORIG_WEBSITE_VAR", __DIR__.'/../../website/var');
define("PIMCORE_WEBSITE_VAR",  TESTS_PATH.'/website/var');

require __DIR__.'/startup.php';