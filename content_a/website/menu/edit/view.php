<?php
namespace content_a\website\menu\edit;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit menu items'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/menu');


	}
}
?>
