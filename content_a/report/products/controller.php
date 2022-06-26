<?php
namespace content_a\report\products;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

		\dash\face::title(T_('Product report'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>