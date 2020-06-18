<?php
namespace content_my\domain\whoisdetail;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Whois Information'));

		\dash\data::userSettingDataRow(\lib\app\nic_usersetting\get::get());

		// btn
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this(). '/option');

	}
}
?>