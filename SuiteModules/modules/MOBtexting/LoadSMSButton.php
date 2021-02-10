<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class LoadSMSButton
{

    public function LoadSMSButton()
    {

        if ($this->isValidLoadButtom()) {
            $siteUrl = $GLOBALS['sugar_config']['site_url'];
            echo '<script type="text/javascript">window.siteUrl = ' . '"' . $siteUrl . '"' . ';</script>';
            echo '<script type="text/javascript" src="modules/MOBtexting/scripts/replaceAndSMS.js"></script>';
            echo '<head><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script></head>';
        }
    }

    public function isValidLoadButtom()
    {

        $noActions = array(
            'modulelistmenu',
            'favorites',
            'Popup',
            'Login',
        );

        if (!empty($_REQUEST['to_pdf']) || !empty($_REQUEST['to_csv'])) {
            return false;
        }

        $noModule = array(
            'ModuleBuilder',
            'Timesheets',
            'Emails',
        );

        if (in_array($_REQUEST['module'], $noModule)) {
            return false;
        }

        return true;

    }

}
