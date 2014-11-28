<?php
class sendnotify_cls
{
	function email($_email, $_param, $_url)
	{
		// $sendnotify = new sendnotify_cls;
		// $sendnotify->email("email","code","url");

		debug_lib::true("Send Email".$_email.' :: '.$_param.' :: '.$_url);

		$myemail	= $_email;
		$mycode		= $_param;
		$myurl		= $_url;

		// *******************************************Send Email
		$to      = "$myemail";
		$subject = 'Jibres Acount Recovery';
		$headers = "From: no-reply@dev.jibres.com" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";

		$message = '<html><body>';

		$message .= '<h1>Jibres</h1><hr />';
		$message .= "<p>Please click the following link to verify your e-mail address and set a password of your choosing.";
		$message .= " Alternatively you can copy-paste the link into your browser's address bar or verify code: $_param.<br /><br />";
		$message .= '<p style="direction:ltr"><a href="http://dev.samac.ir/accounts/recovery/'. $_url .
					'">http://dev.samac.ir/accounts/recovery/'. $_url .'</a></p>';

		$message .= '<br /><p>Best regards, Samac Team</p>';
		$message .= '</body></html>';

		mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	function sms($_mobile, $_param= null , $_status= null)
	{
		$_status	= is_null($_status)? config_lib::$method: $_status;
		// var_dump(config_lib::$method);
		// exit();
		$mymessage	= 'جیبرس'."\n";
		switch ($_status) 
		{
			case 'signup':
				$mymessage .= 'کد فعال سازی حساب کاربری شما '.$_param.' می باشد.';
				break;

			case 'recovery':
				$mymessage .= 'کد بازیابی کلمه عبور شما '.$_param.' میباشد.';
				break;

			case 'verification':
				$mymessage .= 'اعتبارسنجی حساب کاربری شما با موفقیت انجام شد.';
				break;

			default:
				$mymessage .= 'وضعیت مشخص نیست! لطفا این پیغام را به بخش پشتیبانی اطلاع دهید!!';
				break;
		}
		$mymessage .= "\n\n".'Jibres.com';
		// var_dump($mymessage); exit();

		if(substr($_mobile,0,3)=='+98')
			$iran = true;

		if($iran)
		{
			require(cls."/KavenegarApi.php");

			$api = new KavenegarApi();
			$result = $api->send($_mobile, $mymessage);
			// $result = $api->select(27657835);
			// $result = $api->cancel(27657835);
			// $result = $api->selectoutbox(1410570000);
			// $result = $api->account_info();
			
			// var_dump($result);
			// exit();
		}
		else
		{
			debug_lib::fatal('Now we only support Iran!');
		}
	}
}
?>
