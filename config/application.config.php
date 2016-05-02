<?php
/**
 * Configuration file generated by ZFTool dereck xxxx xzxz\
 * The previous configuration file is stored in application.config.old
 *
 * @see https://github.com/zendframework/ZFTool
 */
return array(
    'modules' => array(
       	'ZendDeveloperTools',
        'DoctrineModule',
        'DoctrineORMModule',
        'Produto',
        'Base',
        'Admin',
    	'Usuario',
    	'EmailZF2'	
        ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'config_glob_paths' => array('config/autoload/{,*.}{global,local}.php')
        )
    );