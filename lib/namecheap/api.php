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
			// var_dump($response);exit();
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
			$domain_only_name = $domain_name;

			$tld = null;
			if($domain_name)
			{
				$split       = explode('.', $domain_name);

				$tld         = end($split);
				array_pop($split);
				$domain_only_name = implode('.', $split);
			}

			$available = isset($temp['Available']) ? $temp['Available'] : null;
			if($available === 'false')
			{
				$available = false;
			}
			else
			{
				$available = true;
			}

			$domain_restricted = isset($temp['IsPremiumName'])				? $temp['IsPremiumName']				: null;
			if($domain_restricted === 'false')
			{
				$domain_restricted = false;
			}
			else
			{
				$domain_restricted = true;
			}


			$price_1year = \lib\app\onlinenic\price::one_year($tld);
			$currency = T_("Toman");

			$domains[$domain_name] =
			[
				'name'                     => $domain_only_name,
				'available'                => $available,
				'ErrorNo'                  => isset($temp['ErrorNo'])					? $temp['ErrorNo']						: null,
				'Description'              => isset($temp['Description'])				? $temp['Description']					: null,
				'domain_premium'           => $domain_restricted,
				'IsPremiumName'            => isset($temp['IsPremiumName'])	? $temp['IsPremiumName']		: null,
				'PremiumRegistrationPrice' => isset($temp['PremiumRegistrationPrice'])	? $temp['PremiumRegistrationPrice']		: null,
				'PremiumRenewalPrice'      => isset($temp['PremiumRenewalPrice'])		? $temp['PremiumRenewalPrice']			: null,
				'PremiumRestorePrice'      => isset($temp['PremiumRestorePrice'])		? $temp['PremiumRestorePrice']			: null,
				'PremiumTransferPrice'     => isset($temp['PremiumTransferPrice'])		? $temp['PremiumTransferPrice']			: null,
				'IcannFee'                 => isset($temp['IcannFee'])					? $temp['IcannFee']						: null,
				'EapFee'                   => isset($temp['EapFee'])					? $temp['EapFee']						: null,
				'tld'                      => $tld,
				'price_1year'              => $price_1year,
				'unit'                     => $currency,
			];

      		// 'domain_name_valid' => boolean true

		}


		return $domains;
	}

}
?>