<?php
namespace content_a\website\body\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit body line'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

	}
}
?>
