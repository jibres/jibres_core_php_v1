<?php
namespace content_a\setting\domain;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Google Analytics'));


		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>