<?php
namespace content_love\plan\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Plan detail"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/datalist');





	}
}
?>
