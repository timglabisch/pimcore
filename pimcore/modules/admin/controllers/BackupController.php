<?php
/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license dsf sdaf asdf asdf
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Admin_BackupController extends Pimcore_Controller_Action_Admin {

    /** @var \de\any\iDi !inject */
    public $di;

    /** @var \Pimcore_Env !inject */
    public $pimcoreEnv;

    /** @var \Zend_Session_Namespace */
    public $session = null;
    
    public function init() {

        parent::init();
        
    }

    /**
     * @return \Zend_Session_Namespace
     */
    public function getSession() {

        if($this->session === null)
            $this->session = new Zend_Session_Namespace("pimcore_backup");

        return $this->session;
    }

    /**
     * @return \Pimcore_Backup
     */
    public function getBackupSession() {

        if(!isset($this->getSession()->backup) || !$this->getSession()->backup) {
            $this->getSession()->backup = $this->di->get('\Pimcore_Backup');
            $this->getSession()->backup->setBackupFile($this->pimcoreEnv->getBackupDirectory() . "/backup_" . date("m-d-Y_H-i") . ".tar");
        }
        
        return $this->getSession()->backup;
    }

    public function initAction() {
        $this->_helper->json($this->getBackupSession()->init());
    }

    public function filesAction() {

        $this->_helper->json($this->getBackupSession()->fileStep($this->_getParam("step")));
    }

    public function mysqlTablesAction() {

        $this->_helper->json($this->getBackupSession()->mysqlTables());
    }

    public function mysqlAction() {

        $name = $this->_getParam("name");
        $type = $this->_getParam("type");
        
        $this->_helper->json($this->getBackupSession()->mysqlData($name, $type));
    }

    public function mysqlCompleteAction() {

        $this->_helper->json($this->getBackupSession()->mysqlComplete());
    }

    public function completeAction() {
        
        $this->_helper->json($this->getBackupSession()->complete());
    }

    public function downloadAction() {

        header("Content-Type: application/tar");
        header('Content-Disposition: attachment; filename="' . basename($this->getBackupSession()->getBackupFile()) . '"');
        readfile($this->getBackupSession()->getBackupFile());
        
        exit;
    }
}
