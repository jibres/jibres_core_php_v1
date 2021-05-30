<?php
namespace content_a\setting\factor;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Factor setting'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>