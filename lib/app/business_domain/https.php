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

			return json_encode($_data, JSON_UNESCAPED_UNICODE);
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


		$get_https_setting = \lib\arvancloud\api::get_arvan_request($domain);


		if(isset($get_https_setting['data']) && is_array($get_https_setting['data']))
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_result', ['meta' => self::meta($get_https_setting)]);

			if(array_key_exists('f_ssl_type', $get_https_setting['data']) && $get_https_setting['data']['f_ssl_type'] === 'off')
			{
				$send_request = true;
			}
			elseif(array_key_exists('f_ssl_type', $get_https_setting['data']) && $get_https_setting['data']['f_ssl_type'] === 'arvan')
			{
				if(isset($get_https_setting['data']['f_ssl_status']) && $get_https_setting['data']['f_ssl_status'])
				{
					\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_request_ok', ['meta' => self::meta($get_https_setting)]);

					\lib\app\business_domain\edit::edit_raw(['status' => 'ok', 'httpsverify' => 1, 'httpsrequest' => date("Y-m-d H:i:s")], $_id);

					\dash\notif::ok(T_("HTTPS request is OK"));

					return true;
				}
				else
				{
					\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_request_not_ok', ['meta' => self::meta($get_https_setting)]);
					$send_request = true;
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
				"f_ssl_type" => "arvan",
			];

			$set_https['ssl_type'] = \lib\arvancloud\api::set_arvan_request_https($domain, $add_https_args);


			$add_https_args =
			[
				"ar_wildcard" => true,
			];

			$set_https['ar_wildcard'] = \lib\arvancloud\api::set_arvan_request($domain, $add_https_args);

			\lib\app\business_domain\action::new_action($_id, 'arvancloud_https_request_sended', ['meta' => self::meta($set_https)]);
			\lib\app\business_domain\edit::set_date($_id, 'httpsrequest');
			\dash\notif::ok(T_("HTTPS request was sended"));
			return true;
		}

	}
}
?>