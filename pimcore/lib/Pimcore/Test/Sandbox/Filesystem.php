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


class Pimcore_Test_Sandbox_Filesystem {

     function reset() {
         if(is_dir(TESTS_PATH)) {
             $this->RecursiveRm(TESTS_PATH);
         }

         mkdir(PIMCORE_WEBSITE_VAR, 0777, true);
         $this->RecursiveCopy(TESTS_ORIG_WEBSITE_VAR, PIMCORE_WEBSITE_VAR);
     }

     protected function RecursiveCopy($src, $dst){
         $dir = opendir($src);
         @mkdir($dst, 0777);
         while(false !== ( $file = readdir($dir)) ) {
             if (( $file != '.' ) && ( $file != '..' )) {
                 if ( is_dir($src . '/' . $file) ) {
                     $this->RecursiveCopy($src . '/' . $file,$dst . '/' . $file);
                 }
                 else {
                     copy($src . '/' . $file,$dst . '/' . $file);
                     chmod($dst . '/' . $file, 0777);
                 }
             }
         }
         closedir($dir);
     }

     protected function RecursiveRm($dir) {
         $files = array_diff(scandir($dir), array('.','..'));
         foreach ($files as $file) {
             (is_dir("$dir/$file")) ? $this->RecursiveRm("$dir/$file") : unlink("$dir/$file");
         }
         return rmdir($dir);
     }
 }