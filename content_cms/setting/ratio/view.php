<?php
namespace content_cms\setting\ratio;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Set image ratio'));
		\dash\data::back_text(T_("Setting"));
		\dash\data::back_link(\dash\url::this());

	}
}
?>