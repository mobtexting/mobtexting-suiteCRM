<?php

$admin_options_defs = array();
$admin_options_defs['Administration']['Configuration'] = array(
    'PANELSETTINGS',
    'LBL_MOBTEXTING_SMS_CONFIGURATION_TITLE',
    'LBL_MOBTEXTING_SMS_CONFIGURATION_DESC',
    './index.php?module=MOBtexting'
);
$admin_group_header[] = array(
    'LBL_MOBTEXTING_SMS_TITLE',
    'LBL_MOBTEXTING_SMS_DESC',
    false,
    $admin_options_defs
);

