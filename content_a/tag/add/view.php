<?php
namespace content_a\tag\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new Tag'));

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>