<?php
namespace content_su\smsclient\home;

class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		$master_api_key = null; // \dash\option::sms('kavenegar', 'masterkey');
		if(!$master_api_key)
		{
			// $master_api_key = \dash\option::sms('kavenegar', 'apikey');
		}

		// send sms
		$api    = new \dash\utility\kavenegar_api($master_api_key);
		$result = $api->client_list();
		if(!is_array($result))
		{
			\dash\notif::error(T_("Unavailable list"));
			return false;
		}

		\dash\data::dataTable($result);

	}
}
?>