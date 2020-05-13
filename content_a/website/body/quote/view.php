<?php
namespace content_a\website\body\quote;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage quote'));

		// back
		\dash\data::back_quote(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

	}
}
?>
