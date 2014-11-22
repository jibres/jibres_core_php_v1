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
	}
}
?>
