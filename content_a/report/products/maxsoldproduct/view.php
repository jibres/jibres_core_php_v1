<?php
namespace content_a\report\products\maxsoldproduct;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product report'));

		\dash\permission::access('_group_setting');


		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>