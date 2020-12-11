<?php
namespace lib\app\website\footer\template;

class footer_300
{
	public static function get()
	{
		$myFooter =
		[
			'key'          => 'footer_300',
			'title'        => T_("Footer #300"),
			'desc'         => T_("A modern and beautiful template to introduce your news \n This footer contain your store title and description and have one menu at top"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer300.png',
			'version'      => 2,
			'tag'          =>
			[
				'news'   => T_('#news'),
				'modern' => T_('#modern'),
				'menu'   => T_('#menu'),
			],
			'contain'      =>
			[

				'footer_main_txt' =>
				[
					"title" => T_("Footer Text"),
				],
			],

		];

		return $myFooter;
	}
}
?>