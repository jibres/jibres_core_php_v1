<?php
namespace content_a\buy;


class view
{
	public static function config()
	{
		\dash\permission::access('aFactorAdd');

		\dash\data::page_title(T_('Buy invoicing'));
		\dash\data::page_desc(T_('Add buy from supplier will update stock and price of products automatically.'));
		\dash\data::page_pictogram('buy-sign');

		\dash\data::badge_text(T_('Back to last sales'));
		\dash\data::badge_link(\dash\url::here(). '/factor?type=buy');
	}
}
?>
