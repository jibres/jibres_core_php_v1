<?php
namespace content_pardakhtyar\shop\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit shop"));
		\dash\data::page_desc(T_('Edit name or description of this shop or change status of it.'));
		\dash\data::page_pictogram('edit');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to list of shops'));

		$id     = \dash\request::get('id');
		$result = \lib\pardakhtyar\app\shop::get($id);

		if(!$result)
		{
			\dash\header::status(403, T_("Invalid shop id"));
		}

		\dash\data::dataRowShop($result);

	}
}
?>