<?php

error_reporting(0);
global $sugar_config;

$sms = new MOBtexting();

$options = array(
    'mobtexting_user' =>'setUser',
    'mobtexting_password' =>'setPass',
    'mobtexting_access_token' =>'setAccessToken',
    'mobtexting_sender' =>'setSender',
    'mobtexting_service' =>'setService',
);

foreach ($options as $option => $setter) {
    if (isset($sugar_config[$option])) {
        $value = $sugar_config[$option];
        $sms->$setter($value);
    }

}


$sms->setExtension($_POST['ext'])->setNumber($_POST['num']);
$sms->sendsms();

class MOBtexting
{

    protected $_user;
    protected $_pass;
    protected $_accessToken;
    protected $_sender;
    protected $_service;
    protected $_timeOut = 5000;
    protected $_number = null;
    protected $_extension = null;

    public function __construct()
    {
        // error_log(print_r(openlog('MOBtexting', LOG_NDELAY | LOG_PID, LOG_LOCAL0),true),3,"er.log");

        openlog('MOBtexting', LOG_NDELAY | LOG_PID, LOG_LOCAL0);
    }

    public function __destruct()
    {
        closelog();
    }

    public function sendsms()
    {
         $extension  = $this->getExtension();
         $numberCall = $this->cleanNumber($this->getNumber());
         $urlApi = "https://portal.mobtexting.com/api/v2/sms/send?access_token=" . $this->getAccessToken()."&service=".$this->getService()."&sender=".$this->getSender()."&message=".$_POST['message']."&to=".$numberCall;
      
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => $urlApi,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$this->getAccessToken()
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $checkResult = json_decode($response); 
        if(!empty($checkResult->status))
        {
            // error_log(print_r($response,true), 3,"suitecrmapi.log");
            echo $response;
            exit();
        }
        else
        {
            $json = '{"status": "201","message": "Access Token Invalid"}'; 
            error_log(print_r($json,true), 3,"suitecrmapi.log");

            echo $json;
            exit();

        }


    }

    public function readResponse($socket, $timeout = 5000)
    {

        $retVal = '';
        stream_set_timeout($socket, 0, $timeout);
        while (($buffer = fgets($socket, 20)) !== false) {
            $retVal .= $buffer;
        }

        syslog(LOG_DEBUG, '::-> readResponse :: ' . $retVal);

        return $retVal;
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
            ')'
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

/*MOBtexting*/

    //accesstoken
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
        return $this;
    }
    public function getAccessToken()
    {
        
        return $this->_accessToken;
    }
    //sender
    public function setSender($sender)
    {
        $this->_sender = $sender;
        return $this;
    }
    public function getSender()
    {
        
        return $this->_sender;
    }
    //service
    public function setService($service)
    {
        $this->_service = $service;
        return $this;
    }
    public function getService()
    {
        
        return $this->_service;
    }
    
}

