<?php
namespace lib\app\business_domain;

class cdnpanel
{
	private static function meta($_data)
	{
		if(is_array($_data) || is_object($_data))
		{
			return json_encode($_data, JSON_UNESCAPED_UNICODE);
		}
		return null;
	}


	public static function remove($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}


		$domain = $load['domain'];

		\lib\app\business_domain\edit::unset_date($_id, 'cdnpanel');

		$check_exist_domain_on_cdn_panel = \lib\arvancloud\api::get_domain($domain);

		if(isset($check_exist_domain_on_cdn_panel['data']['id']))
		{
			$arvan_domain_id = $check_exist_domain_on_cdn_panel['data']['id'];
		}
		else
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_error', ['desc' => "can not load domain detail", 'meta' => self::meta($check_exist_domain_on_cdn_panel)]);
			\dash\notif::error(T_("ID of this domain is not found in CDN panel"));
			return false;
		}

		$remove_domain = \lib\arvancloud\api::delete_domain($domain, $arvan_domain_id);

		\lib\app\business_domain\action::new_action($_id, 'arvancloud_remove_domain', ['desc' => "Domain remove result", 'meta' => self::meta($remove_domain)]);

		\lib\app\business_domain\edit::unset_date($_id, 'cdnpanel');

		\dash\notif::ok(T_("Domain successfully removed from CDN panel"));
		return true;
	}


	public static function add($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		if(isset($load['checkdns']) && $load['checkdns'])
		{
			// ok DNS is ok
		}
		else
		{
			\dash\notif::warn(T_("DNS record of this domain is not set on our DNS!"));
			// return false;
		}

		if(isset($load['cdn']) && $load['cdn'])
		{

		}
		else
		{
			\dash\notif::error(T_("CDN field is not valid"));
			return false;
		}

		$domain = $load['domain'];

		$check_exist_domain_on_cdn_panel = \lib\arvancloud\api::get_domain($domain);

		if(!$check_exist_domain_on_cdn_panel || !is_array($check_exist_domain_on_cdn_panel))
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_error', ['desc' => "arvancloud not responded"]);
			\dash\notif::error(T_("Sorry, Can not connect to CDN API to connect your domain. Please Try again"));
			return false;
		}


		if(array_key_exists('status', $check_exist_domain_on_cdn_panel) && !$check_exist_domain_on_cdn_panel['status'])
		{
			// domain is not exist on CDN panel
			// continue in bellow line
		}
		else
		{
			if(isset($check_exist_domain_on_cdn_panel['data']['id']))
			{
				\lib\app\business_domain\edit::set_date($_id, 'cdnpanel');

				\lib\app\business_domain\action::new_action($_id, 'arvancloud_domain_add_duplicate', ['desc' => "This domain is already added to CDN panel", 'meta' => self::meta($check_exist_domain_on_cdn_panel)]);
				\dash\notif::info(T_("This domain already added in CDN panel"));
				return true;
			}
			else
			{
				\lib\app\business_domain\action::new_action($_id, 'arvancloud_error', ['desc' => "arvancloud not responded", 'meta' => self::meta($check_exist_domain_on_cdn_panel)]);
				\dash\notif::error(T_("Oops! Unknown error!"));
				return false;
			}
		}


		$add_domain = \lib\arvancloud\api::add_domain($domain);


		if(isset($add_domain['data']['id']))
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_domain_add', ['desc' => "Domain successfully added to CDN panel", 'meta' => self::meta($add_domain)]);


			// fetch dns record
			$result_fetch = \lib\arvancloud\api::check_dns_record($domain);
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_dns_check', ['meta' => self::meta($result_fetch)]);


			\lib\app\business_domain\edit::set_date($_id, 'cdnpanel');
			\dash\notif::ok(T_("Domain successfully added to CDN panel"));
			return true;

		}
		elseif(isset($add_domain['message']) && $add_domain['message'] === 'The given data was invalid.')
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_error', ['desc' => "This domain is already is use in CDN panel", 'meta' => self::meta($add_domain)]);
			\dash\notif::error(T_("This domain is already in use in CDN panel"));
			return false;
		}
		else
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_error', ['desc' => "Can not add domain to CND panel", 'meta' => self::meta($add_domain)]);
			\dash\notif::error(T_("Can not add domain to CND panel"));
			return false;
		}

	}

}
?>