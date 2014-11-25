<?php
	// require(cls."Kavenegar/exceptions/BaseException.php");
	// require(cls."Kavenegar/exceptions/HttpException.php");
	// require(cls."Kavenegar/exceptions/ApiException.php");
	// var_dump(file_exists( cls."Kavenegar/exceptions/ApiException.php"));
	require(cls."Kavenegar/models/AccountInfoResult.php");
	require(cls."Kavenegar/models/SendResult.php");
	require(cls."Kavenegar/models/ReciveResult.php");
	require(cls."Kavenegar/models/StatusResult.php");

	class  KavenegarApi
	{
		protected $apikey;
		const apipath = "http://api.kavenegar.com/v1/%s/%s/%s.json";
		public function __construct($_apikey)
		{
			$this->apikey = $_apikey;
		}
		private   function get_path($base,$method)
		{
			return sprintf(self::apipath,$this->apikey,$base,$method);
		}
		private  function execute($url,$data)
    	{
        	$headers = array (
            	'Accept: application/json',
            	'Content-Type: application/x-www-form-urlencoded',
        	);
			$fields_string = "";
			if(!is_null($data))
			{
				foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string, '&');
			}
			// var_dump($fields_string);
			//======================================================================================//
        	$handle = curl_init();
	        curl_setopt($handle, CURLOPT_URL, $url);
	        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($handle, CURLOPT_POST, true);
	        curl_setopt($handle, CURLOPT_POSTFIELDS, $fields_string);
	        $response = curl_exec($handle);
	        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	        curl_close ($handle);
	        //=====================================================================================//
	        $json_data = json_decode($response,true);
			$json_return = $json_data["return"];
	        if($json_return["status"] != 200) {
	        	// throw new ApiException($json_return["message"], $json_return["status"]);
	        	var_dump('Api Exception: '.$json_return["message"]. $json_return["status"]);
	        }
	        if($code != 200) {
 				// throw new HttpExcetion("Request have errors", $code);
 				var_dump('http: '.$code);
	        }
	        return $json_data["entries"];
	    }
 		public function send($sender,$receptor,$message,$type = 1,$date = 0)
 		{
 			$receptors = $receptor;
 			if(is_array($receptor))
 			{
 				$receptors = join(",",$receptor);
 			}
			$path =   $this->get_path("sms","send");
			$params = array("message" => $message , "sender" => $sender , "receptor" => $receptors , "type" => $type,"date" => $date);
			$json = $this->execute($path,$params);
			$list = array();
			if(!is_array($json))
				// exit();
			var_dump($json);
			foreach($json as $item)
			{
				$result = new SendResult();
				$result->set_messageid($item['messageid']);
				$result->set_message($item['message']);
				$result->set_receptor($item['receptor']);
				$result->set_date($item['date']);
				$result->set_cost($item['cost']);
				$result->set_status($item['status']);
				$result->set_statustext($item['statustext']);
				array_push($list,$result);
			}
			var_dump($list);
			if(is_array($receptor))
			{
				return $list;
			}
			else
			{
			    return $list[0];
			}
 		}
		public function send_array($sender,$receptors,$messages,$type=1,$date = 0)
		{
			$senders = array();
			$types = array();
			if(is_array($sender))
			{
				$senders = $sender;
			} 
			else
			{
				for ($i = 0; $i < count($receptors); $i++) {
					array_push($senders,$sender);
				}
			}
			if(is_array($type))
			{
				$types = $type;
			} 
			else
			{
				for ($i = 0; $i < count($receptors); $i++) {
					array_push($types,$type);
				}
			}
			
			$path = $this->get_path("sms","sendarray");
			$params = array("receptor" => json_encode($receptors) , "sender" => json_encode($senders) , "message" => json_encode($messages), "date" => $date , "type" => json_encode($types));
			$json = $this->execute($path,$params);
			$list = array();
			foreach($json as $item)
			{
				$result = new SendResult();
				$result->set_messageid($item['messageid']);
				$result->set_message($item['message']);
				$result->set_receptor($item['receptor']);
				$result->set_date($item['date']);
				$result->set_cost($item['cost']);
				$result->set_status($item['status']);
				$result->set_statustext($item['statustext']);
				array_push($list,$result);
			}
			return $list;
		}
		public function select($ids) 
		{
			$id = $ids;
			if(is_array($ids))
			{
				$id = join(",",$ids);
			}
			$path = $this->get_path("sms","select");
			$json = $this->execute($path,array("messageid" => $id)); // @todo ********************************
			$list = array();
			foreach($json as $item)
			{
				$result = new SendResult();
				$result->set_messageid($item['messageid']);
				$result->set_message($item['message']);
				$result->set_receptor($item['receptor']);
				$result->set_date($item['date']);
				$result->set_cost($item['cost']);
				$result->set_status($item['status']);
				$result->set_statustext($item['statustext']);
				array_push($list,$result);
			}
			if(is_array($ids))
			{
				return $list;
			}
			else
			{
			    return $list[0];
			}
		}
		public function status($ids)
		{
			$id = $ids;
			if(is_array($ids))
			{
				$id = join(",",$ids);
			}
			$path = $this->get_path("sms","status");
			$json = $this->execute($path,array("messageid" => $id));
			$list = array();
			foreach($json as $item)
			{
				$result = new StatusResult();
				$result->set_messageid($item['messageid']);
				$result->set_status($item['status']);
				$result->set_statustext($item['statustext']);
				array_push($list,$result);
			}
			if(is_array($ids))
			{
				return $list;
			}
			else
			{
			    return $list[0];
			}
		}
		public function cancel($ids)
		{
			$id = $ids;
			if(is_array($ids))
			{
				$id = join(",",$ids);
			}
			$path = $this->get_path("sms","cancel");
			$json = $this->execute($path,array("messageid" => $id));
			$list = array();
			foreach($json as $item)
			{
				$result = new StatusResult();
				$result->set_messageid($item['messageid']);
				$result->set_status($item['status']);
				$result->set_statustext($item['statustext']);
				array_push($list,$result);
			}
			if(is_array($ids))
			{
				return $list;
			}
			else
			{
			    return $list[0];
			}
		}
		public function unreads($linenumber,$isread=0)
		{
			$path = $this->get_path("sms","unreads");
			$params = array("isread" => $isread , "linenumber" => $linenumber);
			$json = $this->execute($path,$params);
			$list  = array();
			foreach($json as $item)
			{
				$result = new ReciveResult();
				$result->set_messageid($item['messageid']);
				$result->set_sender($item['sender']);
				$result->set_receptor($item['receptor']);
				$result->set_message($item['message']);
				$result->set_date($item['date']);
				array_push($list,$result);
			}
			return $list;
		}
		public function account_info()
		{
			$path = $this->get_path("account","info");
			$json = $this->execute($path,null);
			$result = new AccountInfoResult();
			$result->set_type($json['type']);
			$result->set_credit($json['remaincredit']);
			$result->set_expiredate($json['expiredate']);
			return result;
		}
	}	

?>

