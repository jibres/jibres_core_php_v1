<?php
namespace content_pardakhtyar\customer\add;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Add new customer"));
		\dash\data::page_desc(T_('Increase number of customers by add new customer.'));
		\dash\data::page_pictogram('plus-circle');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to list of customers'));

	}
}
?>