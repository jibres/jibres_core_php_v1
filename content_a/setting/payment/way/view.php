<?php
namespace content_a\setting\payment\way;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Payment'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>
