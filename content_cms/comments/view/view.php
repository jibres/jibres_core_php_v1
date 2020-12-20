<?php
namespace content_cms\comments\view;

class view
{
	public static function config()
	{

		$id = \dash\request::get('id');

		\dash\face::title(T_("Edit comment"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Comments'));

	}
}
?>