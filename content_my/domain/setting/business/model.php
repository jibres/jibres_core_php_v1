<?php
namespace content_my\domain\setting\transfer;


class model
{
	public static function post()
	{

		if(\dash\request::post('myaction') == 'lock')
		{
			if(\lib\nic\mode::api())
			{
				$get_api     = new \lib\nic\api();
				$load_domain = $get_api->domain_lock(\dash\data::domainDetail_id());
			}
			else
			{
				$result = \lib\app\domains\lock::lock(\dash\data::myDomain());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
		elseif(\dash\request::post('myaction') == 'unlock')
		{
			if(\lib\nic\mode::api())
			{
				$get_api     = new \lib\nic\api();
				$load_domain = $get_api->domain_unlock(\dash\data::domainDetail_id());
			}
			else
			{
				$result = \lib\app\domains\lock::unlock(\dash\data::myDomain());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

	}
}
?>