<?php
namespace content_crm\transactions\report;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Transaction Report"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$report = \dash\app\transaction\report::income_monthly();
		\dash\data::reportDetail($report);

	}
}
?>