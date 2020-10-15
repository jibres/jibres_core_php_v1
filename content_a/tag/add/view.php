<?php
namespace content_a\tag\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new tag'));

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>