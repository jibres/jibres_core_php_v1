<?php
namespace content_a\setting\order\seller;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Store legal information'));

		\dash\data::back_text(T_('Order setting'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>
