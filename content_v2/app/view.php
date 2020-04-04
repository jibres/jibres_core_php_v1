<?php
namespace content_v2\app;


class view
{

	public static function config()
	{
		$detail = self::detail_v2();
		\content_v2\tools::say($detail);
	}




	private static function detail_v2()
	{
		$detail = [];

		self::homepage($detail);

		self::payment($detail);
		self::shipping_way($detail);

		self::lang($detail);
		self::url($detail);
		self::site($detail);
		self::version($detail);
		self::menu($detail);
		self::transalate($detail);
		// self::navigation($detail);
		self::intro($detail);
		self::theme_default($detail);
		self::theme_night($detail);
		self::ad($detail);

		return $detail;
	}


	private static function payment(&$detail)
	{
		$detail['payment'] = \lib\app\setting\get::payment();
		// j($detail['payment']);
	}


	private static function shipping_way(&$detail)
	{
		$detail['shipping'] = [];
		$detail['shipping']['way'] = \lib\app\setting\get::shipping_way();
	}



	private static function ad(&$detail)
	{
		$detail['ad']           = [];
		$detail['ad']['top']    =
		[
			'content' => null,
			'link'    => null,
		];
		$detail['ad']['bottom'] = [];
	}


	private static function lang(&$detail)
	{
		$lang_list = \dash\language::all();
		if(is_array($lang_list))
		{
			foreach ($lang_list as $key => $value)
			{
				if($key === 'fa')
				{
					$lang_list[$key]['api_url'] = 'https://jibres.ir/api/v2';
				}
				else
				{
					$lang_list[$key]['api_url'] = 'https://jibres.com/api/v2';
				}
			}
		}
		$detail['lang_list'] = $lang_list;

	}


	private static function url(&$detail)
	{
		if(\dash\language::current() === 'fa')
		{
			$detail['url']['site']    = 'https://jibres.ir';
			$detail['url']['kingdom'] = 'https://jibres.ir';
			$detail['url']['domain']  = 'jibres.ir';
			$detail['url']['root']    = 'jibres';
			$detail['url']['enter']   = 'https://jibres.ir/enter/app';
			$detail['url']['update']  = 'https://jibres.ir/app/update';
		}
		else
		{
			$detail['url']['site']    = 'https://jibres.com';
			$detail['url']['kingdom'] = 'https://jibres.com';
			$detail['url']['domain']  = 'jibres.com';
			$detail['url']['root']    = 'jibres';
			$detail['url']['enter']   = 'https://jibres.com/enter/app';
			$detail['url']['update']  = 'https://jibres.com/app/update';
		}

	}


	private static function site(&$detail)
	{
		$detail['site']['name']   = T_(\dash\face::siteTitle()));
		$detail['site']['desc']   = T_(\dash\face::siteDesc()));
		$detail['site']['slogan'] = T_(\dash\face::siteSlogan()));
		$detail['site']['logo']   = \dash\url::icon();
	}


	private static function version(&$detail)
	{
		$detail['version']                     = [];
		$detail['version']['last']             = 1;
		$detail['version']['deprecated']       = 0;
		$detail['version']['deprecated_title'] = null;
		$detail['version']['deprecated_desc']  = null;
		$detail['version']['update_title']     = null;
		$detail['version']['update_desc']      = null;
	}


	private static function transalate(&$detail)
	{
		$transalate                            = [];
		$transalate['version']                 = T_("Version");
		$transalate['changelang']              = T_("Change language");
		$transalate['close']                   = T_("Close");
		$transalate['back']                    = T_("Back");
		$transalate['go']                      = T_("Go");
		$transalate['enter']                   = T_("Enter");

		$transalate['enter:phone:title']       = T_("Your Phone");
		$transalate['enter:phone:lable']       = T_("Phone Number");
		$transalate['enter:phone:placeholder'] = null;
		$transalate['enter:phone:desc']        = T_("A 4 digit OTP will be sent via SMS to verify your mobile number");
		$transalate['enter:verify:title']      = T_("Phone Verification");
		$transalate['enter:verify:desc']       = T_("Enter the OTP you received to");
		$transalate['enter:verify:edit']       = T_("Edit");
		$transalate['enter:verify:resend']     = T_("Resend");


		// set translate into detail json
		$detail['transalate'] = $transalate;
	}


	private static function menu(&$detail)
	{
		$menu = [];
		// type enum(defile, url, api, menu, tel, email)
		// $menu[] =
		// [
		// 	'icon'  => 'info',
		// 	'type'  => 'menu',
		// 	'title' => T_("About"),
		// 	'link'  => null,
		// 	'child' =>
		// 	[
		// 		[
		// 			'icon'  => 'android',
		// 			'type'  => 'define',
		// 			'title' => T_("About this version"),
		// 			'link'  => null,
		// 		],
		// 		[
		// 			'icon'  => 'info',
		// 			'type'  => 'api',
		// 			'title' => T_("About us"),
		// 			'link'  => \dash\url::kingdom(). '/api/v2/about',
		// 		],
		// 		[
		// 			'icon'  => 'lock',
		// 			'type'  => 'api',
		// 			'title' => T_("Privacy"),
		// 			'link'  => \dash\url::kingdom(). '/api/v2/privacy',
		// 		],
		// 		[
		// 			'icon'  => 'list',
		// 			'type'  => 'api',
		// 			'title' => T_("Terms"),
		// 			'link'  => \dash\url::kingdom(). '/api/v2/terms',
		// 		],
		// 	],
		// ];

		$menu[] =
		[
			'icon'   => null,
			'target' => 'page',
			'url'    => 'content',
			'title'  => T_("Contact"),
		];

		$menu[] =
		[
			'icon'   => null,
			'target' => 'page',
			'url'    => 'vision',
			'title'  => T_("Vision"),
			'child'  => null,
		];

		$menu[] =
		[
			'icon'   => null,
			'target' => 'page',
			'url'    => 'mission',
			'title'  => T_("Mission"),
		];

		$menu[] =
		[
			'icon'   => null,
			'target' => 'browser',
			'url'    => \dash\url::kingdom(),
			'title'  => T_("Website"),
		];


		$detail['menu']   = $menu;

	}


	private static function navigation(&$detail)
	{
		$navigation = [];
		// type enum(defile, url, api, navigation, tel, email)
		$navigation[] =
		[
			'icon'  => 'setting',
			'type'  => 'define',
			'title' => T_("Setting"),
			'link'  => null,
		];

		$navigation[] =
		[
			'icon'  => 'more',
			'type'  => 'define',
			'title' => T_("More"),
			'link'  => null,
		];

		$navigation[] =
		[
			'icon'  => 'home',
			'type'  => 'url',
			'title' => T_("Home"),
			'link'  => \dash\url::kingdom(). '/app',
		];

		$detail['navigation']   = $navigation;

	}




	private static function intro(&$detail)
	{
		$intro   = [];
		$intro[] =
		[
			'title'       => T_(\dash\face::siteTitle())),
			'desc'        => T_(\dash\face::siteDesc())),
			'bg_from'     => '#ffffff',
			'bg_to'       => '#ffffff',
			'title_color' => '#000000',
			'desc_color'  => '#000000',
			'image'       => \dash\url::icon(),
			'btn'         =>
			[
				[
					'title'  => T_("Next"),
					'action' => 'next',
				],
			],
		];

		$intro[] =
		[
			'title'       => T_('Easy'),
			'desc'        => T_('Easy to use'),
			'bg_from'     => '#ffffff',
			'bg_to'       => '#ffffff',
			'title_color' => '#000000',
			'desc_color'  => '#000000',
			'image'       => \dash\url::icon(),
			'btn'         =>
			[
				[
					'title'  => T_("Prev"),
					'action' => 'prev',
				],
				[
					'title'  => T_("Next"),
					'action' => 'next',
				],
			],
		];

		$intro[] =
		[
			'title'       => T_('Powerful'),
			'desc'        => T_('Best application'),
			'bg_from'     => '#ffffff',
			'bg_to'       => '#ffffff',
			'title_color' => '#000000',
			'desc_color'  => '#000000',
			'image'       => \dash\url::icon(),
			'btn'         =>
			[
				[
					'title'  => T_("Prev"),
					'action' => 'prev',
				],
				[
					'title'  => T_("Next"),
					'action' => 'next',
				],
			],
		];

		$intro[] =
		[
			'title'       => T_('Enjoy'),
			'desc'        => T_('Welcome to our collection'),
			'bg_from'     => '#ffffff',
			'bg_to'       => '#ffffff',
			'title_color' => '#000000',
			'desc_color'  => '#000000',
			'image'       => \dash\url::icon(),
			'btn' =>
			[
				[
					'title'  => T_("Start"),
					'action' => 'start',
				],
			],
		];


		$detail['intro'] = $intro;
	}


	private static function theme_default(&$detail)
	{
		$theme_default           = [];
		$theme_default['splash'] =
		[
			'bg_from' => '#ffffff',
			'bg_to'   => '#ffffff',
			'color'   => '#000000',
		];

		$theme_default['global'] =
		[
			'bg_from'   => '#ffffff',
			'bg_to'     => '#ffffff',
			'color'     => '#000000',
			'btn_from'  => '#ffffff',
			'btn_to'    => '#ffffff',
			'btn_color' => '#000000',
		];

		$theme_default['intro'] =
		[
			'bg_from'      => '#ffffff',
			'bg_to'        => '#ffffff',
			'color'        => '#000000',
			'header_from'  => '#ffffff',
			'header_to'    => '#ffffff',
			'header_color' => '#000000',
			'footer_from'  => '#ffffff',
			'footer_to'    => '#ffffff',
			'footer_color' => '#000000',
		];

		$theme_default['share'] =
		[
			'bg_from'      => '#ffffff',
			'bg_to'        => '#ffffff',
			'color'        => '#000000',
			'header_from'  => '#ffffff',
			'header_to'    => '#ffffff',
			'header_color' => '#000000',
			'footer_from'  => '#ffffff',
			'footer_to'    => '#ffffff',
			'footer_color' => '#000000',
		];

		$theme_default['btn'] =
		[
			"success" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
			"danger" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
			"warn" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
			"info" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
		];

		$detail['theme']['default'] = $theme_default;
	}

	private static function theme_night(&$detail)
	{

		$theme_default           = [];
		$theme_default['splash'] =
		[
			'bg_from' => '#ffffff',
			'bg_to'   => '#ffffff',
			'color'   => '#000000',
		];

		$theme_default['global'] =
		[
			'bg_from'   => '#ffffff',
			'bg_to'     => '#ffffff',
			'color'     => '#000000',
			'btn_from'  => '#ffffff',
			'btn_to'    => '#ffffff',
			'btn_color' => '#000000',
		];

		$theme_default['intro'] =
		[
			'bg_from'      => '#ffffff',
			'bg_to'        => '#ffffff',
			'color'        => '#000000',
			'header_from'  => '#ffffff',
			'header_to'    => '#ffffff',
			'header_color' => '#000000',
			'footer_from'  => '#ffffff',
			'footer_to'    => '#ffffff',
			'footer_color' => '#000000',
		];

		$theme_default['share'] =
		[
			'bg_from'      => '#ffffff',
			'bg_to'        => '#ffffff',
			'color'        => '#000000',
			'header_from'  => '#ffffff',
			'header_to'    => '#ffffff',
			'header_color' => '#000000',
			'footer_from'  => '#ffffff',
			'footer_to'    => '#ffffff',
			'footer_color' => '#000000',
		];

		$theme_default['btn'] =
		[
			"success" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
			"danger" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
			"warn" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
			"info" =>
			[
				'bg_from' => '#ffffff',
				'bg_to'   => '#ffffff',
				'color'   => '#000000',
			],
		];

		$detail['theme']['night'] = $theme_default;

	}



	private static function homepage(&$detail)
	{
		$homepage           = [];
		$homepage[]         = self::slider();
		// $homepage[]         = self::bottonLine();
		$homepage[]         = self::real_bottonLine();
		$homepage[]         = self::promotion();

		$homepage[]         = self::banner(1);
		$homepage[]         = self::banner(2);
		$homepage[]         = self::banner(3);
		$homepage[]         = self::banner(4);
		$homepage[]         = self::banner(5);

		$homepage[]         = self::tile(1);
		$homepage[]         = self::tile(2);
		$homepage[]         = self::tile(3);
		$homepage[]         = self::tile(4);
		$homepage[]         = self::real_tile(5);

		$homepage[]         = self::banner();


		$homepage[]         = self::products();
		$homepage[]         = self::btnTile();
		$homepage[]         = self::text();
		$homepage[]         = self::text2();
		$homepage[]         = self::text3();


		$detail['homepage'] = $homepage;
	}


	private static function slider()
	{
		$slider           = [];
		$slider['type']   = 'slider';
		$slider['ratio']  = 30;
		$slider['margin'] = 4;


		$data = [];

		$data[] =
		[
			"image"  => self::sample_image('09'),
			"url"    => '1',
			"target" => "product",
		];

		$data[] =
		[
			"image"  => self::sample_image('13'),
			"url"    => '2',
			"target" => "product",
		];

		$data[] =
		[
			"image"  => self::sample_image('06'),
			"url"    => '3',
			"target" => "product"
		];

		$data[] =
		[
			"image"  => self::sample_image('14'),
			"url"    => 'contact',
			"target" => "producte"
		];


		$data[] =
		[
			"image"  => self::sample_image('21'),
			"url"    => 'https://jibres.com/category/sample',
			"target" => "webview",
		];

		$data[] =
		[
			"image"  => self::sample_image('30'),
			"url"    => 'https://jibres.com/collection/sample',
			"target" => "browser"
		];

		$data[] =
		[
			"image"  => self::sample_image('14'),
			"url"    => '+989123456789',
			"target" => "tel"
		];


		$data[] =
		[
			"image"  => self::sample_image('09'),
			"url"    => 'info@jires.com',
			"target" => "email"
		];


		$slider['data'] = $data;

		return $slider;
	}


	private static function bottonLine()
	{
		$bottonLine           = [];
		$bottonLine['type']   = 'bottonLine';
		$bottonLine['margin'] = 2;


		$data = [];

		$data[] =
		[
			"title"  => T_("Expensive"),
			"url"    => '2',
			"target" => "product"
		];

		$data[] =
		[
			"title"  => T_("Promotion"),
			"url"    => '1',
			"target" => "product"
		];

		$data[] =
		[
			"title"  => T_("Inexpensive"),
			"url"    => 3,
			"target" => "product",
		];

		$data[] =
		[
			"title"  => T_("Sample"),
			"url"    => 'about',
			"target" => "producte"
		];

		$data[] =
		[
			"title"  => T_("Expensive"),
			"url"    => '3',
			"target" => "product"
		];

		$data[] =
		[
			"title"  => T_("Promotion"),
			"url"    => '3',
			"target" => "producty"
		];

		$data[] =
		[
			"title"  => T_("Inexpensive"),
			"url"    => '9',
			"target" => "product"
		];

		$data[] =
		[
			"title"  => T_("Sample"),
			"url"    => '3',
			"target" => "product"
		];

		$bottonLine['data'] = $data;

		return $bottonLine;
	}


	private static function real_bottonLine()
	{
		$bottonLine           = [];
		$bottonLine['type']   = 'bottonLine';
		$bottonLine['margin'] = 2;

		$meta = [];
		$meta['parent1'] = null;
		$meta['parent2'] = null;
		$meta['parent3'] = null;

		$list = \lib\app\category\search::list(null, $meta);

		$data = [];

		foreach ($list as $key => $value)
		{
			$data[] =
			[
				"title"  => $value['title'],
				"url"    => $value['id'],
				"target" => "category"
			];
		}

		$bottonLine['data'] = $data;

		return $bottonLine;
	}


	private static function promotion()
	{
		$promotion           = [];
		$promotion['type']   = 'promotion';
		$promotion['margin'] = 2;
		$promotion['expire'] =
		[
			"serverttime" => time(),
			"expiretime"  => time() + rand(36000, 190000),
		];
		$promotion['title']   = T_("50% Deals test sample long string test");

		$data = [];

		$data[] =
		[
			"image"      => self::sample_image('09'),
			"url"        => '2',
			"target"     => "product",
			"title"      => "Product1",
			"firstPrice" => 1000,
			"discount"   => 300,
			"price"      => 700,
			"unit"       => T_("Rial"),
		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '33',
			"target"     => "product",
			"title"      => "Product2",
			"firstPrice" => 2000,
			"discount"   => 300,
			"price"      => 1700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '3',
			"target"     => "product",
			"title"      => "Product3",
			"firstPrice" => 3000,
			"discount"   => 300,
			"price"      => 2700,
			"unit"       => "$"
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product4",
			"firstPrice" => 4000,
			"discount"   => 300,
			"price"      => 3700,
			"unit"       => "$"
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product5",
			"firstPrice" => 5000,
			"discount"   => 300,
			"price"      => 4700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('30'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product6",
			"firstPrice" => 6000,
			"discount"   => 300,
			"price"      => 5700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('09'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product1",
			"firstPrice" => 1000,
			"discount"   => 300,
			"price"      => 700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product2",
			"firstPrice" => 2000,
			"discount"   => 300,
			"price"      => 1700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product3",
			"firstPrice" => 3000,
			"discount"   => 300,
			"price"      => 2700,
			"unit"       => "$"
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product4",
			"firstPrice" => 4000,
			"discount"   => 300,
			"price"      => 3700,
			"unit"       => "$"
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product5",
			"firstPrice" => 5000,
			"discount"   => 300,
			"price"      => 4700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('30'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product6",
			"firstPrice" => 6000,
			"discount"   => 300,
			"price"      => 5700,
			"unit"       => T_("Toman"),
		];



		$promotion['data'] = $data;

		return $promotion;
	}



	private static function banner($_count = 1)
	{
		$banner           = [];
		$banner['type']   = 'banner';
		$banner['ratio']  = 30;
		$banner['margin'] = 3;

		$data = [];
		// @check
		$rand = [10,11,12,16,17];
		for ($i=1; $i <= $_count ; $i++)
		{
			$data[] =
			[
				"image"  => self::sample_image($rand[array_rand($rand)]),
				"url"    => '1',
				"target" => "product"
			];
		}

		$banner['data'] = $data;
		return $banner;
	}

	private static function tile($_count = 1)
	{
		$tile           = [];
		$tile['type']   = 'tile';
		$tile['ratio']  = 35;
		$tile['margin'] = 2;

		$data = [];
		$rand = [10,11,12,16,17];
		for ($i=1; $i <= $_count ; $i++)
		{
			$data[] =
			[
				"image"  => self::sample_image($rand[array_rand($rand)]),
				"url"    => '2',
				"target" => "collection"
			];
		}

		$tile['data'] = $data;
		return $tile;
	}


	private static function real_tile($_count = 1)
	{
		$tile           = [];
		$tile['type']   = 'tile';
		$tile['ratio']  = 35;
		$tile['margin'] = 2;

		$data = \lib\app\product\search::variant_list(null, []);

		if(!is_array($data))
		{
			$data = [];
		}

		if($data)
		{

			$myData = [];
			foreach ($data as $key => $value)
			{
				$myData[] =
				[
					"image"  => $value['thumb'],
					"url"    => $value['id'],
					"target" => "product",
				];
			}

		}
		else
		{
			$myData = [];
			$rand = [10,11,12,16,17];
			for ($i=1; $i <= $_count ; $i++)
			{
				$myData[] =
				[
					"image"  => self::sample_image($rand[array_rand($rand)]),
					"url"    => '2',
					"target" => "collection"
				];
			}

		}

		$tile['data'] = $myData;

		return $tile;
	}


	private static function products()
	{
		$products           = [];
		$products['type']   = 'products';
		$products['margin'] = 2;
		$products['desc']   =
		[
			"title"  => "Product group 1",
			"url"    => '123',
			"target" => "product",
			"link"   => 'View Full',
		];

		$data = [];

		$data[] =
		[
			"image"      => self::sample_image('09'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product1",
			"firstPrice" => 1000,
			"discount"   => 300,
			"price"      => 700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product2",
			"firstPrice" => 2000,
			"discount"   => 300,
			"price"      => 1700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product3",
			"firstPrice" => 3000,
			"discount"   => 300,
			"price"      => 2700,
			"unit"       => "$"
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product4",
			"firstPrice" => 4000,
			"discount"   => 300,
			"price"      => 3700,
			"unit"       => "$"
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product5",
			"firstPrice" => 5000,
			"discount"   => 300,
			"price"      => 4700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('30'),
			"url"        => '123',
			"target"     => "product",
			"title"      => "Product6",
			"firstPrice" => 6000,
			"discount"   => 300,
			"price"      => 5700,
			"unit"       => T_("Toman"),
		];


		$products['data'] = $data;

		return $products;
	}

	private static function btnTile()
	{
		$btnTile           = [];
		$btnTile['type']   = 'btnTile';
		$btnTile['margin'] = 2;

		$data = [];

		$data[] =
		[
			"image"  => self::sample_image('09'),
			"url"    => '123',
			"target" => "product",
			"text"   => "Product1",

		];

		$data[] =
		[
			"image"  => self::sample_image('13'),
			"url"    => '123',
			"target" => "product",
			"text"   => "Product2",
		];

		$data[] =
		[
			"image"  => self::sample_image('06'),
			"url"    => '123',
			"target" => "product",
			"text"   => "Product3",
		];

		$data[] =
		[
			"image"  => self::sample_image('14'),
			"url"    => '123',
			"target" => "product",
			"text"   => "Product4",
		];


		$data[] =
		[
			"image"  => self::sample_image('21'),
			"url"    => '123',
			"target" => "product",
			"text"   => "Product5",
		];


		$btnTile['data'] = $data;

		return $btnTile;
	}


	private static function text()
	{
		$text            = [];
		$text['type']    = 'text';
		$text['margin']  = 2;
		$text['justify'] = 'center'; // rigth // left
		$text['text']    = "Hello, Show this text to me. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod \ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo";


		return $text;

	}

	private static function text2()
	{
		$text            = [];
		$text['type']    = 'text';
		$text['margin']  = 5;
		$text['justify'] = 'left'; // rigth // left
		$text['text']    = "Hi";
		return $text;

	}

	private static function text3()
	{
		$text            = [];
		$text['type']    = 'text';
		$text['margin']  = 5;
		$text['justify'] = 'right'; // rigth // left
		$text['text']    = "Hi";
		return $text;

	}


	private static function jibres_temp_url()
	{
		return \dash\url::site();
	}




	public static function sample_image($_id)
	{
		return self::jibres_temp_url(). '/static/images/api-sample/'. $_id. '.jpg';
	}



}
?>