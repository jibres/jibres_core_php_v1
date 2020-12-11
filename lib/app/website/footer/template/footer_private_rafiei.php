<?php
namespace lib\app\website\footer\template;

class footer_private_rafiei
{
	public static function get()
	{
		$myFooter =
		[
			'key'          => 'footer_private_rafiei',
			'title'        => T_("Footer #Rafiei"),
			'desc'         => T_("A complete footer"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer201.jpg',
			'version'      => 1,
			'private'      => true,
			'tag'          =>
			[
				'modern' => T_('#modern'),
				'complete' => T_('#complete'),
			],
			'contain'      =>
			[

				'footer_main_txt' =>
				[
					"title" => T_("Footer Text"),
				],

				'footer_phone' =>
				[
					"title" => T_("Footer Phone number"),
				],

				'footer_menu_1' =>
				[
					"title" => T_("Footer menu #1"),
					"desc" => T_("Part 1 of footer menu"),
				],

				'footer_menu_2' =>
				[
					"title" => T_("Footer menu #2"),
					"desc" => T_("Part 2 of footer menu"),
				],

				'footer_menu_3' =>
				[
					"title" => T_("Footer menu #3"),
					"desc" => T_("Part 3 of footer menu"),
				],

				'footer_menu_4' =>
				[
					"title" => T_("Footer menu #4"),
					"desc" => T_("Part 4 of footer menu"),
				],
			],
		];

		return $myFooter;
	}
}
?>