<?php
namespace content_cms\tag\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new tag'));

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>