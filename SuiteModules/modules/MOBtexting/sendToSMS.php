<?php
error_reporting(0);
global $sugar_config;
$sms     = new MOBtexting();
$options = array(
    //api
    'mobtexting_user'                    => 'setUser',
    'mobtexting_password'                => 'setPass',
    'mobtexting_access_token'            => 'setAccessToken',
    'mobtexting_sender'                  => 'setSender',
    'mobtexting_service'                 => 'setService',
    'mobtexting_active'                  => 'setActive',
    //template config contact
    'mobtexting_template_active'         => 'setTemplateActive',
    'mobtexting_template_access'         => 'setTemplateAccess',
    'mobtexting_template_number_options' => 'setTemplateNumberOption',
    'mobtexting_template_body'           => 'setTemplateBody',
    //template config lead
    'mobtexting_lead_active'             => 'setLeadActive',
    'mobtexting_lead_access'             => 'setLeadAccess',
    'mobtexting_lead_number_options'     => 'setLeadNumberOption',
    'mobtexting_lead_body'               => 'setLeadBody',
);
foreach ($options as $option => $setter) {
    if (isset($sugar_config[$option])) {
        $value = $sugar_config[$option];
        $sms->$setter($value);
    }
}
//when call javascript sms manually
if (!empty($_POST['num'])) {
    $sms->setExtension($_POST['ext'])->setNumber($_POST['num']);
    $sms->sendsms();

}

class MOBtexting
{
    //api
    protected $_user;
    protected $_pass;
    protected $_accessToken;
    protected $_sender;
    protected $_service;
    protected $_active;
    //template config contact
    protected $_templateActive;
    protected $_templateAccess;
    protected $_templateNumberOption;
    protected $_templateBody;
    //template config lead
    protected $_leadActive;
    protected $_leadAccess;
    protected $_leadNumberOption;
    protected $_leadBody;

    protected $_timeOut   = 5000;
    protected $_number    = null;
    protected $_extension = null;

    public function __construct()
    {
        openlog('MOBtexting', LOG_NDELAY | LOG_PID, LOG_LOCAL0);
    }

    public function __destruct()
    {
        closelog();
    }

    public function cleanNumber($number)
    {

        $num = trim($number);
        $num = str_replace(array(
            '-',
            ' ',
            '%',
            '+',
            '(',
            ')',
        ), '', $num);

        return $num;

    }

    public function setTimeOut($timeOut)
    {
        $this->_timeOut = $timeOut;
        return $this;
    }

    public function getTimeOut()
    {
        return $this->_timeOut;
    }

    public function setNumber($number)
    {
        $this->_number = $number;
        return $this;
    }

    public function getNumber()
    {
        return $this->_number;
    }

    public function setExtension($extension)
    {
        $this->_extension = $extension;
        return $this;
    }

    public function getExtension()
    {
        return $this->_extension;
    }

    public function setUser($user)
    {
        $this->_user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function setPass($pass)
    {
        $this->_pass = $pass;
        return $this;
    }

    public function getPass()
    {
        return $this->_pass;
    }

/*MOBtexting Api Config*/ 
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
        return $this;
    }
    public function getAccessToken()
    {

        return $this->_accessToken;
    }

    public function setSender($sender)
    {
        $this->_sender = $sender;
        return $this;
    }
    public function getSender()
    {

        return $this->_sender;
    }

    public function setService($service)
    {
        $this->_service = $service;
        return $this;
    }
    public function getService()
    {

        return $this->_service;
    }

    public function setActive($active)
    {
        $this->_active = $active;
        return $this;
    }
    public function getActive()
    {

        return $this->_active;
    }

    //Template of contact
    public function setTemplateActive($_templateActive)
    {
        $this->_templateActive = $_templateActive;
        return $this;
    }
    public function getTemplateActive()
    {

        return $this->_templateActive;
    }

    public function setTemplateAccess($templateAccess)
    {
        $this->_templateAccess = $templateAccess;
        return $this;
    }
    public function getTemplateAccess()
    {

        return $this->_templateAccess;
    }

    public function setTemplateNumberOption($templateNumberOption)
    {
        $this->_templateNumberOption = $templateNumberOption;
        return $this;
    }
    public function getTemplateNumberOption()
    {

        return $this->_templateNumberOption;
    }

    public function setTemplateBody($templateBody)
    {
        $this->_templateBody = $templateBody;
        return $this;
    }
    public function getTemplateBody()
    {

        return $this->_templateBody;
    }

    //Template of lead
    public function setLeadActive($leadActive)
    {
        $this->_leadActive = $leadActive;
        return $this;
    }
    public function getLeadActive()
    {

        return $this->_leadActive;
    }

    public function setLeadAccess($leadAccess)
    {
        $this->_leadAccess = $leadAccess;
        return $this;
    }
    public function getLeadAccess()
    {

        return $this->_leadAccess;
    }

    public function setLeadNumberOption($leadNumberOption)
    {
        $this->_leadNumberOption = $leadNumberOption;
        return $this;
    }
    public function getLeadNumberOption()
    {

        return $this->_leadNumberOption;
    }

    public function setLeadBody($leadBody)
    {
        $this->_leadBody = $leadBody;
        return $this;
    }
    public function getLeadBody()
    {

        return $this->_leadBody;
    }

    //SMS actions
    public function sendsms() //javascript

    {
        $active       = $this->getActive();
        $extension    = $this->getExtension();
        $number       = $this->cleanNumber($this->getNumber());
        $access_token = $this->getAccessToken();
        $service      = $this->getService();
        $sender       = $this->getSender();
        $message      = $_POST['message'];
        $response     = $this->apiSender($access_token, $service, $sender, $active, $message, $number);
        $checkResult  = json_decode($response);
        if (!empty($checkResult->status)) {
            echo $response;
            exit();

        } else {
            $json = '{"status": "201","message": "Access Token Invalid"}';
            echo $json;
            exit();

        }
    }

    //welcome template auto generate
    public function template_sendsms($access_token, $service, $sender, $active, $message, $number)
    {
        $number   = $this->cleanNumber($number);
        $response = $this->apiSender($access_token, $service, $sender, $active, $message, $number);

        $checkResult = json_decode($response);
        if (!empty($checkResult->status)) {
            return $response;
            exit();

        } else {
            $json = '{"status": "201","message": "Access Token Invalid"}';
            return $json;
            exit();
        }

    }
    public function apiSender($access_token, $service, $sender, $active, $message, $number)
    {
        if ($active == "yes") {
            $data = array("access_token" => $access_token, "service" => $service, "sender" => $sender, "message" => $message, "to" => $number);
            $urlApi = "https://portal.mobtexting.com/api/v2/sms/send/";
            $curl   = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL            => $urlApi,
                CURLOPT_POSTFIELDS     => $data,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;

        } else {
            $json = '{"status": "505","message": "Configuration Deactived"}';
            return $json;
            exit();
        }

    }

}
