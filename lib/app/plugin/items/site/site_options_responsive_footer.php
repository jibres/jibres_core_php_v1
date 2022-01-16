<?php
namespace lib\app\plugin\items\site;


class site_options_responsive_footer
{

	public static function detail()
	{
		return
		[
			'type'          => 'once',
			'comperatprice' => 4000,
			'price'         => 3000,
			'relase_date'   => '2021-10-24',
			'last_update'   => '2021-10-24',
			'title'         => T_("Customize footer in for application (Responsive)"),
			'description'   => T_("Customize footer in for application (Responsive) description ..."),
			'keywords'      => [T_("site"), T_("blog")],
			'icon'          => ['binoculars', 'bootstrap'],

		];

	}

}
?>