<?php
namespace lib\app\website\header\template;

class header_private_rafiei
{
	public static function get()
	{
		$myHeader =
		[
			'key'          => __CLASS__,
			'title'        => T_("Header #Rafiei"),
			'desc'         => T_("An enterprise theme for rafiei"),
			// 'sample_image' => \dash\url::cdn(). '/img/template/header/header100.jpg',
			'version'      => 1,
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
			],
		];

		return $myHeader;
	}
}
?>