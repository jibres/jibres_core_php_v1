<?php
class sendnotify_cls
{
	function email($tmp_email, $tmp_code, $tmp_url)
	{
		// $sendnotify = new sendnotify_cls;
		// $sendnotify->email("email","code","url");

		debug_lib::true("Send Email".$tmp_email.' :: '.$tmp_code.' :: '.$tmp_url);

		$myemail	= $tmp_email;
		$mycode		= $tmp_code;
		$myurl		= $tmp_url;

		// *******************************************Send Email
		$to      = "$myemail";
		$subject = 'Jibres Acount Recovery';
		$headers = "From: no-reply@dev.jibres.com" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";

		$message = '<html><body>';

		$message .= '<h1>Jibres</h1><hr />';
		$message .= "<p>Please click the following link to verify your e-mail address and set a password of your choosing.";
		$message .= " Alternatively you can copy-paste the link into your browser's address bar or verify code: $tmp_code.<br /><br />";
		$message .= '<p style="direction:ltr"><a href="http://dev.samac.ir/accounts/recovery/'. $tmp_url .
					'">http://dev.samac.ir/accounts/recovery/'. $tmp_url .'</a></p>';

		$message .= '<br /><p>Best regards, Samac Team</p>';
		$message .= '</body></html>';

		mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	function sms($tmp_mobile, $tmp_code)
	{
		// $sendnotify = new sendnotify_cls;
		// $sendnotify->sms("mobile","code");

		debug_lib::true("Send SMS".$tmp_mobile.' :: '.$tmp_code);

			require(cls."/Kavenegar/KavenegarApi.php");

			$api = new KavenegarApi("332F776565494F4D736446712F6D30553061767879673D3D");
			$result = $api->send("30006703323323","09357269759","کد فعال سازی شما: ".$tmp_code."\r\n\n\nجیبرس Jibres.com");
			
			debug_lib::true($result);
		// try
		// {	
		// }
		// catch(ApiException $ex)
		// {
		// 	var_dump('error-Api');
		// 	// echo $ex->errorMessage();
		// }
		// catch(HttpException $ex)
		// {
		// 	var_dump('error-http');
		// 	// echo $ex->errorMessage();
		// }
		
	}

	function sms_iran()
	{

	}

	function sms_other()
	{

	}
}
?>
