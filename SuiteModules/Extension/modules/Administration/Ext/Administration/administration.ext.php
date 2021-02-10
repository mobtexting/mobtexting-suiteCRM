<?php 
 //WARNING: The contents of this file are auto-generated



$admin_options_defs                                     = array();
$admin_options_defs['Administration']['Configuration1'] = array(
    'PANELSETTINGS',
    'LBL_MOBTEXTING_SMS_CONFIGURATION_TITLE',
    'LBL_MOBTEXTING_SMS_CONFIGURATION_DESC',
    './index.php?module=MOBtexting&action=index',
);
$admin_options_defs['Administration']['Configuration2'] = array(
    'PANELSETTINGS',
    'LBL_MOBTEXTING_TEMPLATE_CONFIGURATION_TITLE',
    'LBL_MOBTEXTING_TEMPLATE_CONFIGURATION_DESC',
    './index.php?module=MOBtexting&action=template',
);
$admin_options_defs['Administration']['Configuration3'] = array(
    'PANELSETTINGS',
    'LBL_MOBTEXTING_LEAD_CONFIGURATION_TITLE',
    'LBL_MOBTEXTING_LEAD_CONFIGURATION_DESC',
    './index.php?module=MOBtexting&action=lead',
);

$admin_group_header[] = array(
    'LBL_MOBTEXTING_SMS_TITLE',
    'LBL_MOBTEXTING_SMS_DESC',
    false,
    $admin_options_defs,
);

?>