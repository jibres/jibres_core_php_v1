<?php
namespace content_a\setting\pos\pos;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Point of sale hardwares'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>
