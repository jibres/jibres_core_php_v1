<?php
namespace content_love\plugin\all;


class view
{
	public static function config()
	{
		\dash\face::title(T_("All plugin"));


		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
