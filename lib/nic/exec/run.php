<?php
namespace lib\nic\exec;


class run
{
	public static function send($_xml)
	{
		// create a new cURL resource
		$ch = curl_init();

		//FALSE to stop cURL from verifying the peer's certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//The name of a file containing a PEM formatted certificate.
		curl_setopt($ch, CURLOPT_SSLCERT, self::user_certificate_file());
		//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		//The contents of the "User-Agent: "
		curl_setopt($ch, CURLOPT_USERAGENT, "JIBRES");
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL,"https://epp.nic.ir/submit");
		//TRUE to do a regular HTTP POST.
		curl_setopt($ch, CURLOPT_POST, false);
		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_xml);

		// grab URL and pass it to the browser
		$response = curl_exec($ch);

		var_dump($response);exit();
		if($response === false)	{
			// echo Errors
			return false;
		}
		// close cURL resource, and free up system resources
		curl_close ($ch);
		return $response;

	}


	private static function user_certificate_file()
	{
		$addr = root. 'dash/setting/secret/pem/nic/20200204101606_ro52-irnic_T282.crt';
		if(is_file($addr))
		{
			return $addr;
		}
		return null;
		// if(is_file(root. ''))
	}

	public static function token()
	{
		return '5955591014200204';
	}
}
?>