<?php
namespace lib\app\business_domain;

class https
{


	private static function meta($_data, $_data2 = [])
	{
		if(is_array($_data) || is_object($_data))
		{
			// if($_data2 && is_array($_data2))
			// {
			// 	$_data = array_merge($_data, $_data2);
			// }

			return json_encode($_data);
		}
		return null;
	}

	public static function reset($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		\lib\app\business_domain\edit::edit_raw(['status' => 'pending', 'httpsverify' => null, 'httpsrequest' => null], $_id);
		\dash\notif::ok(T_("HTTPS setting reset"));
		return true;
	}


	public static function fetch($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$domain = $load['domain'];
		$get_https_setting = \lib\api\arvancloud\api::get_ssl($domain);

		\lib\app\business_domain\action::new_action($_id, 'arvancloud_fetch_ssl', ['meta' => self::meta($get_https_setting)]);

		\dash\notif::ok('Fetch SSL complete');

		return $get_https_setting;
	}



	public static function request($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$domain = $load['domain'];

		$https_request = null;
		if(isset($load['httpsrequest']) && $load['httpsrequest'])
		{
			$https_request = $load['httpsrequest'];
		}

		if($https_request)
		{
			if(time() - strtotime($https_request) < (60*10))
			{
				\dash\notif::error(T_("You can send 1 HTTPS request in every 10 minutes"));
				return false;
			}
		}

		$send_request = false;

		if(isset($load['httpsverify']) && $load['httpsverify'])
		{
			\dash\notif::error(T_("HTTPS request of this domain is active. Can not send HTTPS request again!"));
			return false;
		}

		\lib\api\arvancloud\api::check_dns_record($domain);

		$get_domain = \lib\api\arvancloud\api::get_domain($domain);
		if(isset($get_domain['data']['services']['dns']))
		{
			if($get_domain['data']['services']['dns'] === 'active')
			{
				// continue
			}
			else
			{

				// @reza @todo @check too many request of this action on domain fmir.ir.
				\lib\app\business_domain\action::new_action($_id, 'arvancloud_domain_dns_not_active', ['meta' => self::meta($get_domain)]);

				\lib\app\business_domain\edit::edit_raw(['status' => 'dns_not_resolved'], $_id);

				\dash\notif::error(T_("Domain DNS is not active on CDN panel"), ['my_domain' => $domain]);
				return false;
			}
		}
		else
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_get_domani_error', ['meta' => self::meta($get_domain)]);
			\dash\notif::error(T_("Can not get Domain DNS from CDN panel"));
			return false;
		}

		// add dns record before request https if need
		\lib\app\business_domain\dns::check_if_not_exist_add($_id);


		$get_https_setting = \lib\api\arvancloud\api::get_ssl($domain);


		if(isset($get_https_setting['data']) && is_array($get_https_setting['data']))
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_result', ['meta' => self::meta($get_https_setting)]);

			if(array_key_exists('ssl_status', $get_https_setting['data']) && $get_https_setting['data']['ssl_status'] === false)
			{
				$send_request = true;
			}
			elseif(array_key_exists('ssl_status', $get_https_setting['data']) && $get_https_setting['data']['ssl_status'] === true)
			{
				$have_active_cert = false;
				if(is_array(a($get_https_setting, 'data', 'certificates')))
				{
					foreach ($get_https_setting['data']['certificate'] as $cert_detail)
					{
						if(a($cert_detail, 'active'))
						{
							$have_active_cert = true;
						}
					}
				}

				if($have_active_cert)
				{
					// need to update https_redirect.
					// arvan can not enable this option on first request https
					$update_https_args =
					[
						"https_redirect" => true,
						"certificate"    => "managed",
					];

					\lib\api\arvancloud\api::set_arvan_request_ssl($domain, $update_https_args);


					\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_request_ok', ['meta' => self::meta($get_https_setting)]);

					\lib\app\business_domain\edit::edit_raw(['status' => 'ok', 'httpsverify' => 1, 'httpsrequest' => date("Y-m-d H:i:s")], $_id);

					\dash\notif::ok(T_("HTTPS request is OK"));

					$send_log              = [];
					$send_log['my_domain'] = $load['domain'];

					if(isset($load['user_id']) && $load['user_id'])
					{
						$send_log['to'] = $load['user_id'];
						\dash\log::set('domain_successfullConnected', $send_log);
					}

					unset($send_log['to']);

					\dash\log::set('domain_successfullConnectedSu', $send_log);

					return true;
				}
				else
				{
					\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_not_active_yet', ['meta' => self::meta($get_https_setting)]);
					return false;
				}

			}
			else
			{
				\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_unknown', ['meta' => self::meta($get_https_setting)]);
				\dash\log::oops('unknowHTTPSArvanStatus');
				return false;
			}
		}
		else
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_error', ['meta' => self::meta($get_https_setting)]);
			\dash\notif::error(T_("Can not connect to CDN service"));
			return false;
		}


		if($send_request)
		{
			$set_https = [];

			$set_https['current_setting'] = $get_https_setting;

			$add_https_args =
			[
				"ssl_status"     => true,
				"https_redirect" => true,
				"certificate"    => "managed",

			];

			$set_https['ssl_type'] = \lib\api\arvancloud\api::set_arvan_request_ssl($domain, $add_https_args);


			$add_https_args =
			[
				"ar_wildcard" => true,
			];

			$set_https['ar_wildcard'] = \lib\api\arvancloud\api::set_arvan_request($domain, $add_https_args);

			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_request_sended');
			\lib\app\business_domain\edit::set_date($_id, 'httpsrequest');
			\dash\notif::ok(T_("HTTPS request was sended"));
			return true;
		}

	}


	/**
	 * Force enable https_redirect
	 *
	 * @param      <type>  $_id    The identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function ssl_redirect($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$domain = $load['domain'];


		$get_https_setting = \lib\api\arvancloud\api::get_ssl($domain);


		if(isset($get_https_setting['data']) && is_array($get_https_setting['data']))
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_result', ['meta' => self::meta($get_https_setting)]);

			if(array_key_exists('ssl_status', $get_https_setting['data']) && $get_https_setting['data']['ssl_status'] === false)
			{
				\dash\notif::error(T_("SSL of this domain is off!"));
				return false;
			}
			elseif(array_key_exists('ssl_status', $get_https_setting['data']) && $get_https_setting['data']['ssl_status'] === true)
			{
				if(isset($get_https_setting['data']['https_redirect']) && $get_https_setting['data']['https_redirect'])
				{
					\dash\notif::ok(T_("SSL redirect is already activated"));
					return true;
				}
				else
				{
					// need to update https_redirect.
					// arvan can not enable this option on first request https
					$update_https_args =
					[
						"https_redirect" => true,
						"certificate"    => "managed",
					];

					\lib\api\arvancloud\api::set_arvan_request_ssl($domain, $update_https_args);

					\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_request_ok', ['meta' => self::meta($get_https_setting)]);

					// fetch and add jibres dns
					\lib\app\business_domain\dns::check_if_not_exist_add($_id);
				}


			}
			else
			{
				\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_unknown', ['meta' => self::meta($get_https_setting)]);
				\dash\log::oops('unknowHTTPSArvanStatus');
				return false;
			}
		}
		else
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_error', ['meta' => self::meta($get_https_setting)]);
			\dash\notif::error(T_("Can not connect to CDN service"));
			return false;
		}
	}


	public static function force_update_all_https()
	{
		\dash\code::time_limit(0);

		$list = \lib\db\business_domain\get::all_domain_connected();

		if(!$list || !is_array($list))
		{
			\dash\notif::error(T_("No DNS record found by this ip"));
			return false;
		}

		$start_time = time();

		$i = 0;

		foreach ($list as $key => $value)
		{
			$i++;
			$domain = a($value, 'domain');

			if(!$domain)
			{
				continue;
			}

			$add_https_args =
			[
				"https_redirect" => true,
				"certificate"    => "managed",
			];

			\lib\api\arvancloud\api::set_arvan_request_ssl($domain, $add_https_args);

			\lib\api\arvancloud\api::https_upstram($domain, 'auto');

		}

		\dash\notif::ok("Operation complete successfull");
		return true;
	}

}
?>