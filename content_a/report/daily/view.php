<?php
namespace content_a\report\daily;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Report daily'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));

		\dash\data::badge_text(T_('Back to report list'));
		\dash\data::badge_link(\dash\url::this());


		$result = \lib\app\report\daily::last_30_days(30, \dash\request::get('sort'), \dash\request::get('order'));

		\dash\data::sortLink(\content_a\filter::current(['sum', 'date'], \dash\url::current()));


		if(isset($result['chart']))
		{
			\dash\data::ReportDailyChart($result['chart']);
		}

		if(isset($result['table']))
		{
			\dash\data::ReportDailyTable($result['table']);
		}

	}
}
?>
