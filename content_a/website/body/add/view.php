<?php
namespace content_a\website\body\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new block'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


	}
}
?>
