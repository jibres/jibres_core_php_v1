<?php
namespace lib\nic\exec;


class run
{
	public static function send($_xml)
	{
		$_xml = trim($_xml);

		// create a new cURL resource
		$ch = curl_init();

		//FALSE to stop cURL from verifying the peer's certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		//The name of a file containing a PEM formatted certificate.
		curl_setopt($ch, CURLOPT_SSLCERT, self::user_certificate_file());
		//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		//The contents of the "User-Agent: "
		curl_setopt($ch, CURLOPT_USERAGENT, "IRNIC_EPP_Client_Sample");
		// curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent: JIbres");
		//TRUE to do a regular HTTP POST.This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms.
		curl_setopt($ch, CURLOPT_POST, true);
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL,"https://epp.nic.ir/submit");
		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['xmlStr' => $_xml]));

		// grab URL and pass it to the browser
		$response = curl_exec($ch);
		var_dump(curl_error($ch));
		var_dump($response);exit();
		if($response === false)	{
			// echo Errors
			echo 'Curl error: ' . curl_error($ch);
		}
		// close cURL resource, and free up system resources
		curl_close ($ch);


	}


	private static function user_certificate_file()
	{
		$addr = root. 'dash/setting/secret/pem/nic/20200204101606_ro52-irnic_T282.p12';
		$addr = root. 'dash/setting/secret/pem/nic/20200204101606_ro52-irnic_T282.pem';
		$addr = root. 'dash/setting/secret/pem/nic/20200204101606_ro52-irnic_T282.crt';
		if(is_file($addr))
		{
			return $addr;
		}
		return null;

	}

	public static function token()
	{
		return '5955591014200204';
	}
}
?>