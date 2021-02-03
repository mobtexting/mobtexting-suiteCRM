<?php

$manifest = array(
    'acceptable_sugar_versions' => array(
        'exact_matches' => array(
            1 => '6.5.15'
        ),
        'regex_matches' => array(
            1 => '6\.4\.\d',
            2 => '6\.[0-9]\.\d',
            3 => '7\.[0-9]\.\d'
        )
    ),
    'acceptable_sugar_flavors' => array(
        'CE',
        'PRO',
        'ENT',
        'CORP'
    ),
    'readme' => '',
    'key' => '',
    'author' => ' ',
    'description' => 'MOBtexting SMS',
    'icon' => 'logo.svg',
    'is_uninstallable' => true,
    'name' => 'MOBtexting SMS',
    'published_date' => 'January 27, 2021',
    'type' => 'module',
    'version' => 'v0.0.1',
    'remove_tables' => false
);


$installdefs = array(
    'id' => 'MOBtexting',
    'copy' => array(
        0 => array(
            'from' => '<basepath>/SuiteModules/Extension/modules/Administration/Ext/',
            'to' => 'custom/Extension/modules/Administration/Ext'
        ),
        1 => array(
            'from' => '<basepath>/SuiteModules/Extension/modules/Users/Ext/Language',
            'to' => 'custom/Extension/modules/Users/Ext/Language'
        ),
        2 => array(
            'from' => '<basepath>/SuiteModules/modules/MOBtexting',
            'to' => 'modules/MOBtexting'
        ),
        3 => array(
            'from' => '<basepath>/SuiteModules/EntryPoint/MOBtextingSMS.php',
            'to' => 'custom/Extension/application/Ext/EntryPointRegistry/MOBtextingSMS.php'
        )
    ),
    'mkdir' => array(),
    'administration' => array(),
    'custom_fields' => array(
        array(
            'id' => 'extension_id',
            'name' => 'MOBtexting SMS',
            'label' => 'LBL_MOBTEXING_SMS_EXTENSION',
            'type' => 'varchar',
            'module' => 'Users',
            'help' => 'Enter Your Extension',
            'comment' => '',
            'default_value' => '',
            'max_size' => 10,
            'required' => false,
            'reportable' => false,
            'audited' => false,
            'importable' => true,
            'duplicate_merge' => false
        )
    ),
    'logic_hooks' => array(
        array(
            'module' => '',
            'hook' => 'after_ui_footer',
            'order' => 100,
            'description' => 'MOBtexting SMS',
            'file' => 'modules/MOBtexting/LoadSMSButton.php',
            'class' => 'LoadSMSButton',
            'function' => 'LoadSMSButton'
        )
    )
);

$upgrade_manifest = array();
