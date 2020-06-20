<?php
namespace lib\namecheap;


class api
{

	private static $result_raw = [];


	private static function run($_command, $_body = null)
	{
		// live api
		$master_url = "https://api.namecheap.com/xml.response";


		$post_field              = [];

		$post_field['ApiUser']  = \dash\setting\namecheap::ApiUser();
		$post_field['ApiKey']   = \dash\setting\namecheap::ApiKey();
		$post_field['UserName'] = \dash\setting\namecheap::UserName();

		$post_field['Command']  = $_command;
		$post_field['ClientIp']  = \dash\server::ip();

		if(is_array($_body))
		{
			$post_field = array_merge($post_field, $_body);
		}

		// $post_field['DomainList'] = 'jibres.com';

		$post_field['broker_token'] = \dash\setting\namecheap::broker_token();
		$post_field['api_url']      = $master_url;


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		// curl_setopt($ch, CURLOPT_URL, "https://tunnel.jibres.com/domain-broker/");
		curl_setopt($ch, CURLOPT_URL, "https://tunnel.jibres.com/namecheap/");

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_field));

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 41);
		curl_setopt($ch, CURLOPT_TIMEOUT, 41);

		$response = curl_exec($ch);
		$CurlError = curl_error($ch);

		curl_close ($ch);

		if(!$response)
		{
			return false;
		}

		if(!is_string($response))
		{
			return false;
		}

		try
		{
			$object = @new \SimpleXMLElement($response);
			return $object;
		}
		catch (\Exception $e)
		{
			if(\dash\engine\process::status())
			{
				\dash\notif::error(T_("Can not connect to domain server"));
			}
			return false;
		}

		return false;
	}



	// ---------------------------------------- DOMAIN ---------------------------------------- //

	public static function check_domain($_domin)
	{
		if(is_array($_domin))
		{
			if(count($_domin) >= 50)
			{
				return false;
			}

			$_domin = implode(',', $_domin);
		}

		$result = self::run('namecheap.domains.check', ['DomainList' => $_domin]);

		if(!$result)
		{
			return false;
		}


		if(!isset($result->CommandResponse))
		{
			return false;
		}

		$domains = [];

		foreach ($result->CommandResponse->DomainCheckResult as $key => $value)
		{
			$temp = (array) $value;
			if(isset($temp['@attributes']))
			{
				$temp = $temp['@attributes'];
			}

			$domain_name = isset($temp['Domain']) ? $temp['Domain']	: null;
			$tld = null;
			if($domain_name)
			{
				$split = explode('.', $domain_name);
				$tld = end($split);
			}

			$domains[$domain_name] =
			[
				'name'                     => $domain_name,

				'available'                => isset($temp['Available'])					? boolval($temp['Available']) 			: null,
				'ErrorNo'                  => isset($temp['ErrorNo'])					? $temp['ErrorNo']						: null,
				'Description'              => isset($temp['Description'])				? $temp['Description']					: null,
				'domain_restricted'        => isset($temp['IsPremiumName'])				? boolval($temp['IsPremiumName'])				: null,
				'PremiumRegistrationPrice' => isset($temp['PremiumRegistrationPrice'])	? $temp['PremiumRegistrationPrice']		: null,
				'PremiumRenewalPrice'      => isset($temp['PremiumRenewalPrice'])		? $temp['PremiumRenewalPrice']			: null,
				'PremiumRestorePrice'      => isset($temp['PremiumRestorePrice'])		? $temp['PremiumRestorePrice']			: null,
				'PremiumTransferPrice'     => isset($temp['PremiumTransferPrice'])		? $temp['PremiumTransferPrice']			: null,
				'IcannFee'                 => isset($temp['IcannFee'])					? $temp['IcannFee']						: null,
				'EapFee'                   => isset($temp['EapFee'])					? $temp['EapFee']						: null,
				'tld'                      => $tld,
			];

      // 'domain_name_valid' => boolean true

		}


		return $domains;
	}

}
?>