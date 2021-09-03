<?php
namespace lib\app\website\footer\template;

class footer_100
{
	public static function get()
	{
		$myFooter =
		[
			'key'          => 'footer_100',
			'title'        => T_("Footer #1"),
			'desc'         => T_("A modern and beautiful footer"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer100.png',
			'version'      => 3,
			'tag'          =>
			[
				'modern' => T_('#modern'),
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
			],
		];

		return $myFooter;
	}
}
?>