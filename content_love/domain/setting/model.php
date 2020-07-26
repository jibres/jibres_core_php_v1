<?php
namespace content_love\domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('clean') == 'lastfetch' && \dash\permission::supervisor())
		{
			$result = \lib\app\nic_domain\edit::remove_last_fetch(\dash\data::domainDetail_id());
			\dash\notif::ok(T_("Last fetch removed"));
			\dash\redirect::pwd();
			return;
		}


		if(\dash\request::post('myaction') == 'autorenew')
		{
			$autorenew = \dash\request::post('op') == 'set' ? 1 : 0;
			$result = \lib\app\nic_domain\edit::edit(['autorenew' => $autorenew], \dash\data::domainDetail_id(), true);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('myaction') == 'verify')
		{
			$verify = \dash\request::post('op') == 'set' ? 1 : 0;
			$result = \lib\app\nic_domain\edit::edit(['verify' => $verify], \dash\data::domainDetail_id(), true);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('myaction') == 'status')
		{
			$status = \dash\request::post('status');
			$result = \lib\app\nic_domain\edit::edit(['status' => $status], \dash\data::domainDetail_id(), true);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		\dash\notif::warn("This action needs to work!");
		return;
		// if(\dash\request::post('status') == 'remove')
		// {
		// 	if(\lib\nic\mode::api())
		// 	{
		// 		$get_api     = new \lib\nic\api();
		// 		$load_domain = $get_api->domain_delete(\dash\data::domainDetail_id());
		// 	}
		// 	else
		// 	{
		// 		$result = \lib\app\nic_domain\remove::remove(\dash\data::domainDetail_id());
		// 	}

		// 	if(\dash\engine\process::status())
		// 	{
		// 		\dash\redirect::to(\dash\url::this());
		// 	}
		// 	return;
		// }
	}
}
?>