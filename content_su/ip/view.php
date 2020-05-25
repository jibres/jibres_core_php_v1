<?php
namespace content_su\ip;


class view
{
	public static function config()
	{

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