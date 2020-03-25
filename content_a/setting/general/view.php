<?php
namespace content_a\setting\general;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('General'));


		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>