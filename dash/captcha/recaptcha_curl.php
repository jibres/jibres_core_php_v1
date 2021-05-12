<?php
namespace dash\captcha;

/**
 * This class describes google recaptcha.
 */
class recaptcha_curl
{

	public static function verify($_secret, $_token, $_ip = null)
	{
		$data =
		[
			'secret'   => $_secret,
			'response' => $_token,
		];

		if($_ip)
		{
			$data['remoteip'] = $_ip;
		}

		$header =
		[
			'Content-Type: application/x-www-form-urlencoded'
		];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLINFO_HEADER_OUT, false);

		$response = curl_exec($ch);

		$CurlError = curl_error($ch);

		curl_close($ch);

		$log = json_encode(['curl_error' => $CurlError, 'response' => $response ], JSON_UNESCAPED_UNICODE);

		if(!$response || !is_string($response))
		{
			\dash\log::file($log, 'google_recaptcha_error.log', 'google');
			return false;
		}

		$response = json_decode($response, true);

		if(!is_array($response))
		{
			$response = [];
		}

		if(!array_key_exists('success', $response))
		{
			\dash\log::file($log, 'google_recaptcha_error.log', 'google');
		}

		return $response;

	}
}
?>