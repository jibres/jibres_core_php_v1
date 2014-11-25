<?php

	define('API_KEY', '332F776565494F4D736446712F6D30553061767879673D3D');
	define('API_PATH', 'http://api.kavenegar.com/v1/%s/%s/%s.json');

	require 'helpers/ApiHelper.php';
	require 'helpers/RestHelper.php';
	class  KaveSample {

		public function intialize()
		{
			//$this->send();
			$this->sendArray(array("شماره گیرنده","شماره گیرنده"),array("شماره ارسال کننده ","شماره ارسال کننده"),array("پیام اول","پیام اول"),0);
		}
 		public function send()
 		{
			$path =   ApiHelper::getApiPath("sms","send");
			$result = RestHelper::doPost($path,"POST",array("message" => "salam" , "sender" =>"30006703323323" , "receptor" => "09357269759"));
			echo $result;
 		}
		public function sendArray($receptor,$sender,$message,$date)
		{
			$path = ApiHelper::getApiPath("sms","sendarray");
			$result = RestHelper::doPost($path,"POST",array("receptor" => json_encode($receptor) , "sender" => json_encode($sender) , "message" => json_encode($message), "date" => $date));
			echo $result;
		}
	} 
	//Run Sample ==========================================================================//
	$sample = new KaveSample();
	$sample->intialize();
	var_dump("finish!");

?>