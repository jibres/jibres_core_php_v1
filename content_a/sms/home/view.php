<?php
namespace content_a\sms\home;


use lib\app\sms\smsCheck;

class view
{
	public static function config()
	{
		\dash\face::title(T_("sms"));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		// // TODO need to set sms hashtag in help center
        // \dash\face::help(\dash\url::support(). '/hashtag/sms');
		// \dash\face::help(\dash\url::support());


		\dash\data::mysmsDetail(\lib\app\sms\businesssmsDetail::getMyCurrentsmsDetail());
//		var_dump(\dash\data::mysmsDetail());exit();


	}
}
?>
