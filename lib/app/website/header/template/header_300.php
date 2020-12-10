<?php
namespace lib\app\website\header\template;

class header_300
{
	public static function get()
	{
		$myHeader =
		[
			'key'          => __CLASS__,
			'title'        => T_("Header #300"),
			'desc'         => T_("A modern and beautiful template to introduce your news \n This header contain your store title and description and have one menu at top"),
			'sample_image' => \dash\url::cdn(). '/img/template/header/header300.jpg',
			'version'      => 2,
			'tag'          =>
			[
				'news'   => T_('#news'),
				'modern' => T_('#modern'),
				'menu'   => T_('#menu'),
			],
			'contain'      =>
			[
				'header_menu_1' =>
				[
					"title" => T_("Header Primary Menu"),
				],
			],

		];

		return $myHeader;
	}
}
?>