<?php
namespace content_cms\posts\share;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Post smart share"));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/advance?id='. \dash\request::get('id'));


		\dash\face::btnSave('form1');
		\dash\face::btnSaveText(T_("Share"));




		$telegram_setting = \lib\app\setting\get::telegram_setting();
		\dash\data::telegramSetting($telegram_setting);

	    // @javad
	    // $telegram_setting contain:
		// 'apikey' => string 'apikey'
		// 'channel' => string 'channel id'
		// 'share_text' => string 'default share text'


	}
}
?>
