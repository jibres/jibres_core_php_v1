<?php
namespace lib\nic;
/**
 * Jibres Domain PHP SDK
 * This function work by version 10 of jibres core api
 * @see https://core.jibres.com/r10/doc
 */

class api
{

	private $result_raw = [];


	private function run($_path, $_method, $_param = null, $_body = null)
	{

		$appkey    = '[YOUR APP KEY]';
		$apikey    = '[YOUR API KEY]';
		$registrar = '[Domain registrar]';
		$master_url = "https://core.jibres.com/%s/%s/%s";


		$appkey    = 'd4690f919c32165b1541ffe28a57324c';
		$apikey    = '55e77fe05aa4126fa739a6f21829c454';
		$registrar = 'irnic';
		$master_url = "https://core.jibres.local/%s/%s/%s";


		$header =
		[
        	'Content-Type:application/json',
        	'appkey: '. $appkey,
        	'apikey: '. $apikey,
		];

		$url = sprintf($master_url, 'r10', $registrar, $_path);

		if($_param && is_array($_param))
		{
			$url .= '?'. http_build_query($_param);
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, mb_strtoupper($_method));
		curl_setopt($ch, CURLOPT_URL, $url);

		if($_body && is_array($_body))
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_body, JSON_UNESCAPED_UNICODE));
		}

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);

		$response = curl_exec($ch);

		$CurlError = curl_error($ch);

		curl_close ($ch);

		if(!$response)
		{
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			var_dump($response);exit();
			return false;
		}

		if(!array_key_exists('ok', $result))
		{
			return false;
		}

		if(!$result['ok'])
		{
			// build error
			return false;
		}

		$this->result_raw = $result;

		if(isset($result['result']))
		{
			return $result['result'];
		}

		return false;
	}


	/**
	 * Get result meta
	 *
	 * @param      <type>  $_key   The key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function meta($_key)
	{
		if(isset($this->result_raw['meta'][$_key]))
		{
			return $this->result_raw['meta'][$_key];
		}

		return null;
	}

	/**
	 * get contact list
	 */
	public function contact_fetch()
	{
		$result = self::run('contact/fetch', 'get');
		return $result;
	}

	/**
	 * Locad one contact detail
	 */
	public function contact_load($_id)
	{
		$result = self::run('contact', 'get', ['id' => $_id]);
		return $result;
	}

}
?>