<?php
namespace content_love\plugin\who;


class view
{
	public static function config()
	{
		$result = [];

		$result['activeplugin'] = \lib\db\store_plugin\get::active_plugin();
		$result['smscharge'] = \lib\db\store_plugin\get::active_plugin_sms();


		\dash\data::result($result);



		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());



	}
}
?>
