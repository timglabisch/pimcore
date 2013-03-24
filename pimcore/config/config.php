<?php

return array(
    'service_manager' => array(
        'invokables' => array(
            'Pimcore' =>  '\Pimcore',
            'Logger' =>  '\Logger'
        ),
        'factories' => array(
            'Zend_Controller_Front' => function() {
                return Zend_Controller_Front::getInstance();
            }
        )
    )
);