<?php
namespace content_crm\member\glance;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Glance user'));

		\dash\data::back_text(T_("Customers"));
		\dash\data::back_link(\dash\url::this());
	}
}
?>