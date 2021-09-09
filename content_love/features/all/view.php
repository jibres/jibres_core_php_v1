<?php
namespace content_love\features\all;


class view
{
	public static function config()
	{
		\dash\face::title(T_("All features"));


		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
