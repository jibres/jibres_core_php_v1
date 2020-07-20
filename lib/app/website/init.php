<?php
namespace lib\app\website;

class init
{
	public static function status()
	{
		\lib\app\website\status\set::status(['status' => 'publish']);
		\dash\notif::clean();
	}


	public static function header()
	{
		\lib\app\website\header\set::set_header_template(['header' => 'header_100']);
		\dash\notif::clean();
	}


	public static function footer()
	{
		\lib\app\website\footer\set::set_footer_template(['footer' => 'footer_100']);
		\dash\notif::clean();
	}


	public static function body()
	{
		$post =
		[
			'title'   => T_("Latest products"),
			'publish' => 1,
			'type'    => 'latestproduct',
			'cat_id'  => null,
		];
		$productline = \lib\app\website\body\line\productline::add($post);

		$post =
		[
			'title'   => T_("Random products"),
			'publish' => 1,
			'type'    => 'randomproduct',
			'cat_id'  => null,
		];

		$productline = \lib\app\website\body\line\productline::add($post);

		\dash\notif::clean();
	}
}
?>