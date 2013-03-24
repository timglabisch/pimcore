<?php

class Pimcore_Service_Manager extends Zend\ServiceManager\ServiceManager {

    function __construct(\Zend\ServiceManager\ConfigInterface $config = null) {
        parent::__construct($config);

        // add some defaults
        $serviceManager = $this;

        $this->addInitializer(function ($instance) use ($serviceManager) {
            if ($instance instanceof Zend\ServiceManager\ServiceManagerAwareInterface) {
                $instance->setServiceManager($serviceManager);
            }
        });

        $this->addInitializer(function ($instance) use ($serviceManager) {
            if ($instance instanceof Zend\ServiceManager\ServiceLocatorAwareInterface) {
                $instance->setServiceLocator($serviceManager);
            }
        });

        $this->setService('ServiceManager', $serviceManager);
        $this->setAlias('Zend\ServiceManager\ServiceLocatorInterface', 'ServiceManager');
        $this->setAlias('Zend\ServiceManager\ServiceManager', 'ServiceManager');
    }

    /**
     * @return \Logger
     */
    function getLogger() {
        return $this->get('Logger');
    }

    /**
     * @return \Pimcore
     */
    function getPimcore() {
        return $this->get('Pimcore');
    }

}