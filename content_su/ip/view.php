<?php
namespace content_su\ip;


class view
{
	public static function config()
	{

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		$ip = $_SERVER['REMOTE_ADDR'];
		$details = json_decode(@file_get_contents("http://ipinfo.io/{$ip}/json"), true);
		\dash\data::ipDetail($details);

		$args =
		[

		];


		$search_string = \dash\request::get('q');

		$list = \dash\utility\ip::list($search_string, $args);

		\dash\data::dataTable($list);


	}
}
?>