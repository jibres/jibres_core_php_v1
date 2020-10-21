<?php
namespace lib\app\website\header;

class topline
{

	public static function set($_args)
	{

		$condition =
		[
			'text'   => 'string_100',
			'url'    => 'string_100',
			'target' => 'bit',
			'status' => 'bit',
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$topline = json_encode($data, JSON_UNESCAPED_UNICODE);

		$query_result = \lib\db\setting\update::overwirte_platform_cat_key($topline, 'website', 'header', 'topline');

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Your website announcement was saved"));

		return true;
	}


	public static function get()
	{
		$topline = \lib\db\setting\get::platform_cat_key( 'website', 'header', 'topline');
		if(isset($topline['value']) && is_string($topline['value']))
		{
			$topline = json_decode($topline['value'], true);
		}

		if(!is_array($topline))
		{
			$topline = [];
		}

		return $topline;
	}

}
?>
