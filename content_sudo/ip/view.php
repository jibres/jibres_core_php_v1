<?php
namespace content_sudo\ip;


class view
{
	public static function config()
	{

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		$args =
		[

		];


		$search_string = \dash\validate::search_string();

		$list = \dash\utility\ip::list($search_string, $args);

		\dash\data::dataTable($list);


	}
}
?>