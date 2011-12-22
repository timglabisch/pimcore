<?php
class Pimcore_Env {
    private $documentRoot;
    private $frontendModule;
    private $path;
    private $pluginsPath;
    private $websitePath;
    private $configurationDirectory;
    private $configurationSystem;
    private $configurationPlugins;
    private $assetDirectory;
    private $versionDirectory;
    private $webdavTemp;
    private $logDebug;
    private $logMailTemp;
    private $temporaryDirectory;
    private $cacheDirectory;
    private $classDirectory;
    private $backupDirectory;
    private $recyclebinDirectory;
    private $systemTempDirectory;

    public function setWebsitePath($websitePath)
    {
        $this->websitePath = $websitePath;
    }

    public function getWebsitePath()
    {
        return PIMCORE_WEBSITE_PATH;
        return $this->websitePath;
    }

    public function setAssetDirectory($assetDirectory)
    {
        $this->assetDirectory = $assetDirectory;
    }

    public function getAssetDirectory()
    {
        return PIMCORE_ASSET_DIRECTORY;
        return $this->assetDirectory;
    }

    public function setBackupDirectory($backupDirectory)
    {
        $this->backupDirectory = $backupDirectory;
    }

    public function getBackupDirectory()
    {
        return PIMCORE_BACKUP_DIRECTORY;
        return $this->backupDirectory;
    }

    public function setCacheDirectory($cacheDirectory)
    {
        $this->cacheDirectory = $cacheDirectory;
    }

    public function getCacheDirectory()
    {
        return PIMCORE_CACHE_DIRECTORY;
        return $this->cacheDirectory;
    }

    public function setClassDirectory($classDirectory)
    {
        $this->classDirectory = $classDirectory;
    }

    public function getClassDirectory()
    {
        return PIMCORE_CLASS_DIRECTORY;
        return $this->classDirectory;
    }

    public function setConfigurationDirectory($configurationDirectory)
    {
        $this->configurationDirectory = $configurationDirectory;
    }

    public function getConfigurationDirectory()
    {
        return PIMCORE_CONFIGURATION_DIRECTORY;
        return $this->configurationDirectory;
    }

    public function setConfigurationPlugins($configurationPlugins)
    {
        $this->configurationPlugins = $configurationPlugins;
    }

    public function getConfigurationPlugins()
    {
        return PIMCORE_CONFIGURATION_DIRECTORY;
        return $this->configurationPlugins;
    }

    public function setConfigurationSystem($configurationSystem)
    {
        $this->configurationSystem = $configurationSystem;
    }

    public function getConfigurationSystem()
    {
        return PIMCORE_CONFIGURATION_SYSTEM;
        return $this->configurationSystem;
    }

    public function setDocumentRoot($documentRoot)
    {
        $this->documentRoot = $documentRoot;
    }

    public function getDocumentRoot()
    {
        return PIMCORE_DOCUMENT_ROOT;
        return $this->documentRoot;
    }

    public function setFrontendModule($frontendModule)
    {
        $this->frontendModule = $frontendModule;
    }

    public function getFrontendModule()
    {
        return PIMCORE_FRONTEND_MODULE;
        return $this->frontendModule;
    }

    public function setLogDebug($logDebug)
    {
        $this->logDebug = $logDebug;
    }

    public function getLogDebug()
    {
        return PIMCORE_LOG_DEBUG;
        return $this->logDebug;
    }

    public function setLogMailTemp($logMailTemp)
    {
        $this->logMailTemp = $logMailTemp;
    }

    public function getLogMailTemp()
    {
        return PIMCORE_LOG_MAIL_TEMP;
        return $this->logMailTemp;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return PIMCORE_PATH;
        return $this->path;
    }

    public function setPluginsPath($pluginsPath)
    {
        $this->pluginsPath = $pluginsPath;
    }

    public function getPluginsPath()
    {
        return PIMCORE_PLUGINS_PATH;
        return $this->pluginsPath;
    }

    public function setRecyclebinDirectory($recyclebinDirectory)
    {
        $this->recyclebinDirectory = $recyclebinDirectory;
    }

    public function getRecyclebinDirectory()
    {
        return PIMCORE_RECYCLEBIN_DIRECTORY;
        return $this->recyclebinDirectory;
    }

    public function setSystemTempDirectory($systemTempDirectory)
    {
        $this->systemTempDirectory = $systemTempDirectory;
    }

    public function getSystemTempDirectory()
    {
        return PIMCORE_SYSTEM_TEMP_DIRECTORY;
        return $this->systemTempDirectory;
    }

    public function setTemporaryDirectory($temporaryDirectory)
    {
        $this->temporaryDirectory = $temporaryDirectory;
    }

    public function getTemporaryDirectory()
    {
        return PIMCORE_TEMPORARY_DIRECTORY;
        return $this->temporaryDirectory;
    }

    public function setVersionDirectory($versionDirectory)
    {
        $this->versionDirectory = $versionDirectory;
    }

    public function getVersionDirectory()
    {
        return PIMCORE_VERSION_DIRECTORY;
        return $this->versionDirectory;
    }

    public function setWebdavTemp($webdavTemp)
    {
        $this->webdavTemp = $webdavTemp;
    }

    public function getWebdavTemp()
    {
        return PIMCORE_WEBDAV_TEMP;
        return $this->webdavTemp;
    }
}