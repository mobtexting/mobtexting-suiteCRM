<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/SugarFeed/feedLogicBase.php';
error_reporting(0);
class MobtextingAutoSMS extends FeedLogicBase
{
    public $module = 'Contacts';

    public function pushFeed($bean, $event, $arguments)
    {
        if ($_REQUEST['module']) {

            $this->module = $_REQUEST['module'];

        }

        global $locale;
        $text = '';

        if (empty($bean->fetched_row)) {
            $text = '{SugarFeed.CREATED_CONTACT} [' . $bean->module_dir . ':' . $bean->id . ':' . $locale->getLocaleFormattedName($bean->first_name, $bean->last_name) . ']';

            $string = $locale->getLocaleFormattedName($bean->phone_work, $bean->phone_mobile);

            $names = $locale->getLocaleFormattedName($bean->first_name, $bean->last_name);

            $getNames   = explode(" ", $names);
            $numberType = explode(" ", $string);
            $office     = $numberType[0];
            $mobile     = $numberType[1];
            $first_name = $getNames[0];
            $last_name  = $getNames[1];

            require_once 'modules/MOBtexting/sendToSMS.php';

            $sms          = $sms;
            $sender       = $sms->getSender();
            $service      = $sms->getService();
            $access_token = $sms->getAccessToken();
            $active       = $sms->getActive();
            // if contact
            if ($this->module == "Contacts") {

                $templateActive = $sms->getTemplateActive();
                $getTemplatemsg = $sms->getTemplateBody();
            }
            if ($this->module == "Leads") {

                $templateActive = $sms->getLeadActive();
                $getTemplatemsg = $sms->getLeadBody();
            }
            //or lead

            $msg     = trim($getTemplatemsg);
            $numbers = array();
            if (!empty($mobile)) {

                if (preg_match("/^\d+\.?\d*$/", $mobile) && strlen($mobile) >= 10) {

                    array_push($numbers, $mobile);

                } else {

                }

            }
            if (!empty($office)) {
                if (preg_match("/^\d+\.?\d*$/", $office) && strlen($office) >= 10) {

                    array_push($numbers, $office);

                } else {

                }
            }
            $number       = implode(',', $numbers);
            $fullname     = $bean->first_name . " " . $bean->last_name;
            $arr_tpl_vars = array('{first-name}', '{last-name}', '{full-name}', '{office-phone}', '{mobile-number}', '{job-title}', '{department}', '{account-name}', '{email}', '{primary-address}', '{primary-city}', '{primary-state}', '{primary-postalcode}', '{primary-country}', '{alter-address}', '{alter-city}', '{alter-state}', '{alter-postalcode}', '{alter-country}', '{description}', '{date}');

            $arr_tpl_data = array($first_name, $last_name, $fullname, $office, $mobile, $bean->title, $bean->department, $bean->account_name, $bean->email1, $bean->primary_address_street, $bean->primary_address_city, $bean->primary_address_state, $bean->primary_address_postalcode, $bean->primary_address_country, $bean->alt_address_street, $bean->alt_address_city, $bean->alt_address_state, $bean->alt_address_postalcode, $bean->alt_address_country, $bean->description, date('d/m/Y'));

            $msg = str_replace($arr_tpl_vars, $arr_tpl_data, $getTemplatemsg);

            if ($templateActive == "yes" && count($numbers) > 0) {

                $result = $sms->template_sendsms($access_token, $service, $sender, $active, $msg, $number);

            } else {

            }
        }

        if (!empty($text)) {
            SugarFeed::pushFeed2($text, $bean);
        }
    }
}
