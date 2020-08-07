<?php
namespace content_a\accounting\report\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting report detail'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$report = \lib\app\tax\doc\report::detail_report();
		\dash\data::reportDetail($report);

	}

}
?>
