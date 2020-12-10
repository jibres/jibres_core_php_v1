<?php
namespace lib\app\website\header\template;

class header_100
{
	public static function get()
	{
		$myHeader =
		[
			'key'          => __CLASS__,
			'title'        => T_("Header #100"),
			'desc'         => T_("A modern and beautiful header"),
			'sample_image' => \dash\url::cdn(). '/img/template/header/header100.jpg',
			'version'      => 3,
			'tag'          =>
			[
				'store'  => T_('#Shop_mode'),
				'modern' => T_('#modern'),
				'cart'   => T_('#cart_manager'),
				'search' => T_('#search_button'),
				'login'  => T_('#login_link'),
				'logo'   => T_('#logo'),
			],
			'contain'      =>
			[
				'header_logo' =>
				[
				],

				'header_menu_1' =>
				[
					"title" => T_("Header Primary Menu"),
				],

				'header_menu_2' =>
				[
					"title" => T_("Header Secondary Menu"),
					"desc"  => T_("This menu is shown on left side of header menu bar.")
				],
			],
		];

		return $myHeader;
	}
}
?>