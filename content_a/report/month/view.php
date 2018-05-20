<?php
namespace content_a\report\month;


class view
{
	public static function config()
	{
		\dash\permission::access('aReportMonth');

		\dash\data::page_title(T_('Report month'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));

		\dash\data::badge_text(T_('Back to report list'));
		\dash\data::badge_link(\dash\url::this());


		$result = \lib\app\report\month::monthly(\dash\request::get('sort'), \dash\request::get('order'));

		\dash\data::sortLink(\content_a\filter::current(['sum', 'date'], \dash\url::current()));


		if(isset($result['chart']))
		{
			\dash\data::ReportMonthlyChart($result['chart']);
		}

		if(isset($result['table']))
		{
			\dash\data::ReportMonthlyTable($result['table']);
		}

	}
}
?>
