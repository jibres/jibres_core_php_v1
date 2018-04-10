<?php
namespace content_a\factor\summary;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Factors Summary'));
		\dash\data::page_desc(T_('Some detail about your factors and choose specefic type to add new type of factor.'));

		\dash\data::badge_text(T_('Quick add new sale factor'));
		\dash\data::badge_link(\dash\url::this(). '/add');


		\dash\data::factorDashboardData(\lib\app\factor::dashboard());
	}
}
?>
