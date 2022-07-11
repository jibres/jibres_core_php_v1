<?php
namespace content_love\portfolio\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new portfolio"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listPortfolioTag(\dash\app\portfolio::list_portfolio_tags());

		\dash\data::dataRow_date(date("Y-m-d"));


	}
}
?>
