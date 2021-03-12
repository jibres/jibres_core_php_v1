<?php
namespace content_my\domain\option;


class model
{
	public static function post()
	{
		$post = [];


		if(\dash\request::post('set_defaultautorenew'))
		{
			$post['defaultautorenew'] = \dash\request::post('defaultautorenew');
			$update = \lib\app\nic_usersetting\set::set($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::ok(T_("Setting of default auto renew saved"));
			}
			return;
		}




		if(\dash\request::post('autorenewperiod'))
		{
			$post['autorenewperiod'] = \dash\request::post('autorenewperiod');
			$update = \lib\app\nic_usersetting\set::set($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::clean();

				if($post['autorenewperiod'] === '1year')
				{
					$title = T_("1 Year");
				}
				else
				{
					$title = T_("5 Year");
				}

				\dash\notif::ok(T_("Setting of auto renew period set on :val", ['val' => $title]));
			}
			return;
		}



		if(\dash\request::post('defaultcontact'))
		{
			$defaultcontact = \dash\request::post('defaultcontact');

			$update = \lib\app\nic_contact\edit::set_default_contact($defaultcontact);

			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::ok(T_("Setting of default contact set on :val", ['val' => $defaultcontact]));
			}
			return;
		}


		$post =
		[
			'ns1'             => \dash\request::post('ns1'),
			'ns2'             => \dash\request::post('ns2'),
			'ns3'             => \dash\request::post('ns3'),
			'ns4'             => \dash\request::post('ns4'),
		];

		$create = \lib\app\nic_usersetting\set::set($post);

		if($create && \dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::ok(T_("Default DNS was updated"));
			return true;
		}

	}
}
?>