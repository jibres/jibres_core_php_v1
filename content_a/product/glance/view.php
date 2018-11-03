<?php
namespace content_a\product\glance;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Glance'));
		\dash\data::page_desc(T_('We gathered all important detail of this product in dashboard for you:)'));
		\dash\data::page_pictogram('diamond');

		\content_a\product\load::fixTitle();


		$dashboard = \lib\app\productprice\dashboard::glance(\dash\request::get('id'));
	}
}
?>
