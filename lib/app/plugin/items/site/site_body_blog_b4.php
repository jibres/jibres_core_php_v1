<?php
namespace lib\app\plugin\items\site;


class site_body_blog_b4
{

	public static function detail()
	{
		return
		[
			'type'          => 'once',
			'comperatprice' => 3000,
			'price'         => 2000,
			'relase_date'   => '2021-10-24',
			'last_update'   => '2021-10-24',
			'title'         => T_("Body blog b4"),
			'description'   => T_("Description"),
			'keywords'      => [T_("site"), T_("blog")],

		];

	}

}
?>