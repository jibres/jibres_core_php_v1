<?php
namespace content_my\domain\option;


class model
{
	public static function post()
	{
		$post = [];

		if(\dash\request::post('autorenewperiod'))
		{
			$post['autorenewperiod'] = \dash\request::post('autorenewperiod');
			$update = \lib\app\nic_usersetting\set::set($post);
			if($update && \dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::ok(T_("Setting of auto renew period set on :val", ['val' => $post['autorenewperiod']]));
			}

			return;
		}


		if(\dash\request::post('domainlifetime'))
		{
			$post['domainlifetime'] = \dash\request::post('domainlifetime');
			$update = \lib\app\nic_usersetting\set::set($post);
			if($update && \dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::ok(T_("Setting of domain life set on :val", ['val' => $post['domainlifetime']]));
			}

			return;
		}

		$post =
		[
			'ns1'             => \dash\request::post('ns1'),
			'ns2'             => \dash\request::post('ns2'),
			'ns3'             => \dash\request::post('ns3'),
			'ns4'             => \dash\request::post('ns4'),
			// 'autorenewperiod' => \dash\request::post('period'),
			// 'domainlifetime'  => \dash\request::post('domainlifetime'),
		];

		if(\lib\nic\mode::api())
		{
			$get_api    = new \lib\nic\api();
			$create     = $get_api->domain_option($post);
		}
		else
		{
			$create = \lib\app\nic_usersetting\set::set($post);
		}

		if($create && \dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>