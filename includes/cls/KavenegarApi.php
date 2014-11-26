<?php
/*
@ Kavenegar Api
@ Version: 2.0
@ Author: Javad Evazzadeh | Evazzadeh.com

Quick Start:
	copy this file in your project and edit KavenegarApi.php first line and insert your apikey and linenumber
	then copy and paste below line to quickly sent message!
		require("KavenegarApi.php");
		$api 	= new KavenegarApi();
		$result = $api->send('09120000000', 'Hi, This is for test!');


How to Use:
	for use this class you must require this file in your project with below line
		require("KavenegarApi.php");

	then you must create an instance from KavenegarApi with below line
		$api = new KavenegarApi();

	you can set the apikey and linenumber from declaration part of class in first lines
	but if you want you can set this parameter on create new instance with below code
		$api = new KavenegarApi('Your-apikey', 'Your-linenumber');

	for use the functions you can use below line sample, this line send message to 09120000000
		$result = $api->send('09120000000', 'Hi, This is for test!');
	
	if you want you can set the line number value after initializing class
		$api->linenumber = '100020003000';

	for access current status and server message you can read status value with below line
	var_dump($api->status);
	var_dump($api->msg);

*/
	class  KavenegarApi
	{
		// declare variable
		// you can replace null with your api code or your default linenumber
		protected $apikey 	= '332F776565494F4D736446712F6D30553061767879673D3D';
		public $linenumber 	= '10006660066600';
		public $status 		= null;
		public $msg 		= null;
		const apipath 		= "http://api.kavenegar.com/v1/%s/%s/%s.json";

		public function __construct($_apikey= null, $_sender= null)
		{
			$this->apikey 	= (is_null($_apikey)) ? $this->apikey : $_apikey;
			$this->linenumber 	= (is_null($_sender)) ? $this->linenumber : $_sender;
		}

		private function get_path($_method, $_base = 'sms')
		{
			return sprintf(self::apipath, $this->apikey, $_base,$_method);
		}

		private function execute($_url, $_data)
    	{
        	$headers = array (
            	'Accept: application/json',
            	'Content-Type: application/x-www-form-urlencoded',
            	'charset: utf-8'
        	);
			$fields_string = null;
			if(!is_null($_data))
			{
				foreach($_data as $key=>$value) { $fields_string.=$key.'='.$value.'&'; }
				rtrim($fields_string, '&');
			}
			// for debug you can uncomment below line to see the send parameters
			// var_dump($_data);

			//======================================================================================//
        	$handle = curl_init();
	        curl_setopt($handle, CURLOPT_URL, $_url);
	        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($handle, CURLOPT_POST, true);
	        curl_setopt($handle, CURLOPT_POSTFIELDS, $fields_string);
	        $response 	= curl_exec($handle);
	        $mycode 	= curl_getinfo($handle, CURLINFO_HTTP_CODE);
	        // check mycode in special situation, if has default code with status handle it
	        curl_close ($handle);
	        //=====================================================================================//
	        // for debug you can uncomment below line to see the result get from server
	        // var_dump($response);
	        if(!$response)
			{
				$this->status 	= -1;
				$this->msg 		= null;
				return 22;
			}

			$json_data		= json_decode($response,true);
			$this->status	= $json_data["return"]["status"];
			$this->msg		= $json_data["return"]["message"];

	        return $json_data["entries"];
	    }

		public function send($_receptor, $_message, $_type= 1, $_date= 0, $_LocalMessageid= null)
		{
			$receptor 	= is_array($_receptor)? join(",", $_receptor): $_receptor;
			$path 		= $this->get_path(__FUNCTION__);
			$params 	= array(
								 "receptor"			=> $receptor,
								 "sender"			=> $this->linenumber,
								 "message"			=> $_message,
								 "type" 			=> $_type,
								 "date" 			=> $_date,
								 "LocalMessageid"	=> $_LocalMessageid
								);
			$json 		= $this->execute($path, $params);
			
			if(!is_array($json))
				return $this->status;

			if(is_array($receptor))
				return $json;
			else
			    return $json[0];
		}

 		public function sendarray($_sender, $_receptor, $_message, $_type= 1, $_date= 0)
 		{
			$sender 	= array();
			$message 	= array();
			$type		= array();

			if(is_array($_sender))
				$sender = $_sender;
			else
				for ($i = 0; $i < count($_receptor); $i++){
					array_push($sender, $_sender);
				}

			if(is_array($_message))
				$message = $_message;
			else
				for ($i = 0; $i < count($_receptor); $i++){
					array_push($message, $_message);
				}

			if(is_array($_type))
				$type 	= $_type;
			else
				for ($i = 0; $i < count($_receptor); $i++){
					array_push($type, $_type);
				}

			$path 		= $this->get_path(__FUNCTION__);
			$params 	= array( 
								 "receptor" 		=> json_encode($_receptor),
								 "sender"			=> json_encode($sender),
								 "message" 			=> json_encode($message),
								 "type" 			=> json_encode($type),
								 "date" 			=> $_date
								);
			$json 		= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			return $json;
 		}

		public function select($_id)
		{
			$id 	= is_array($_id)? join(",", $_id) : $_id;
			$path 	= $this->get_path(__FUNCTION__);
			$params	= array( "messageid" => $id);
			$json 	= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			if(is_array($receptor))
				return $json;
			else
			    return $json[0];
		}

		public function selectoutbox($_startdate, $_enddate= null)
		{
			$path 	= $this->get_path(__FUNCTION__);
			$params	= array(
							 "startdate"	=> $_startdate,
							 "enddate"		=> $_enddate
							);
			$json 	= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			return $json;
		}

		public function latestoutbox($_pagesize = 10)
		{
			$path 	= $this->get_path(__FUNCTION__);
			$params	= array( "pagesize" => $_pagesize);
			$json 	= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			return $json;
		}

		public function status($_id)
		{
			$id 	= is_array($_id)? join(",", $_id) : $_id;
			$path 	= $this->get_path(__FUNCTION__);
			$params	= array( "messageid" => $id);
			$json 	= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			if(is_array($_id))
				return $json;
			else
			    return $json[0];
		}

		public function cancel($_id)
		{
			$id 	= is_array($_id)? join(",", $_id) : $_id;
			$path 	= $this->get_path(__FUNCTION__);
			$params	= array( "messageid" => $id);
			$json 	= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			if(is_array($_id))
				return $json;
			else
			    return $json[0];
		}

		public function unreads($_linenumber= null, $_isread= 0)
		{
			$_linenumber	= is_null($_linenumber)? $this->linenumber: $_linenumber;
			$path 			= $this->get_path(__FUNCTION__);
			$params			= array(
									 "isread"		=> $_isread,
									 "linenumber"	=> $_linenumber
									);
			$json 			= $this->execute($path, $params);

			if(!is_array($json))
				return $this->status;

			return $json;
		}

		public function account_info()
		{
			$path 		= $this->get_path('info','account');
			$json 		= $this->execute($path, null);

			if(!is_array($json))
				return $this->status;

			return $json;
		}
	}
?>