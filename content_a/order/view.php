<?php
namespace content_a\order;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Orders'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::action_text(T_('Add order'));
		\dash\data::action_link(\dash\url::this(). '/add');
	}
}
?>
