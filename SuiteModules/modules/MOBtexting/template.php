<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

if (!is_admin($current_user) && !defined('configurator_util')) {
    sugar_die('Admin Only');
}
require_once 'modules/Configurator/Configurator.php';
require_once 'include/Sugar_Smarty.php';
require_once 'settings_form_mobtexting.php';

global $sugar_config;
global $mod_strings;

echo get_module_title(
    $mod_strings['LBL_MOBTEXTING_TEMPLATE_TITLE'],
    $mod_strings['LBL_MOBTEXTING_TEMPLATE_TITLE'],
    false
);

foreach ($settingsForm as $key => $value) {
    if (!isset($sugar_config[$key])) {
        $sugar_config[$key] = '';
    }
}

$configurator = new Configurator();
$focus        = new Administration();

if (!empty($_POST['save'])) {

    $configurator->saveConfig();
    $focus->saveConfig();
    header('Location: index.php?module=Administration&action=index');
}

$focus->retrieveSettings();

$sugar_smarty = new Sugar_Smarty();
$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('config', $configurator->config);
$sugar_smarty->assign('mobtexting_config', $settingsForm);
$sugar_smarty->assign('error', $configurator->errors);
$sugar_smarty->assign('syntax', "{first-name} : First Name, {last-name} : last Name, {full-name} : Full Name, {office-phone} : Office Phone, {mobile-number} : Mobile Number, {job-title} : Job Title, {department} : Department, {account-name} : Account Name, {email} : Email, {primary-address} : Primary Address,  {primary-city} : Primary City, {primary-state} : Primary State, {primary-postalcode}  : Primary Postalcode, {primary-country} : Primary Country, {alter-address} : Alter Address, {alter-city} : Alter City, {alter-state} : Alter State, {alter-postalcode} : Alter Postalcode, {alter-country} : Alter Country, {description} : Description, {date} : Date");
$sugar_smarty->display('modules/MOBtexting/template_form.tpl');
