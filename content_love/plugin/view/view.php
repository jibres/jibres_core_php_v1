<?php
namespace content_love\plugin\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Vidw plugin"));
		if(\dash\data::pluginDetail_title())
		{
			\dash\face::title(\dash\data::pluginDetail_title());
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');
		






	}
}
?>