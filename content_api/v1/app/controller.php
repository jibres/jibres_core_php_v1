<?php
namespace content_api\v1\app;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}


	public static function api_routing()
	{
		if(!\dash\request::is('get'))
		{
			\content_api\v1::invalid_method();
		}

		$detail = self::detail_v1();

		\content_api\v1::say($detail);
	}



	private static function detail_v1()
	{
		$detail = [];

		self::homepage($detail);
		self::lang($detail);
		self::url($detail);
		self::site($detail);
		self::version($detail);
		self::menu($detail);
		self::transalate($detail);
		self::navigation($detail);
		self::intro($detail);
		self::theme_default($detail);
		self::theme_night($detail);
		self::ad($detail);

		return $detail;
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
				$lang_list[$key]['api_url'] = \dash\url::base().'/'. $key .'/api/v1';
			}
		}
		$detail['lang_list'] = $lang_list;

	}


	private static function url(&$detail)
	{
		$detail['url']['site']    = \dash\url::site();
		$detail['url']['kingdom'] = \dash\url::kingdom();
		$detail['url']['domain']  = \dash\url::domain();
		$detail['url']['root']    = \dash\url::root();
		$detail['url']['enter']    = self::jibres_temp_url(). '/enter/app';
		$detail['url']['update']  = \dash\url::kingdom(). '/app/update';
	}


	private static function site(&$detail)
	{
		$detail['site']['name']   = T_(\dash\option::config('site','title'));
		$detail['site']['desc']   = T_(\dash\option::config('site','desc'));
		$detail['site']['slogan'] = T_(\dash\option::config('site','slogan'));
		$detail['site']['logo']   = self::logo_url();
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
		$transalate               = [];
		$transalate['version']    = T_("Version");
		$transalate['changelang'] = T_("Change language");
		$transalate['close']      = T_("Close");
		$transalate['back']       = T_("Back");
		$transalate['go']         = T_("Go");
		$transalate['enter']      = T_("Enter");

		// set translate into detail json
		$detail['transalate'] = $transalate;
	}


	private static function menu(&$detail)
	{
		$menu = [];
		// type enum(defile, url, api, menu, tel, email)
		$menu[] =
		[
			'icon'  => 'info',
			'type'  => 'menu',
			'title' => T_("About"),
			'link'  => null,
			'child' =>
			[
				[
					'icon'  => 'android',
					'type'  => 'define',
					'title' => T_("About this version"),
					'link'  => null,
				],
				[
					'icon'  => 'info',
					'type'  => 'api',
					'title' => T_("About us"),
					'link'  => \dash\url::kingdom(). '/api/v1/about',
				],
				[
					'icon'  => 'lock',
					'type'  => 'api',
					'title' => T_("Privacy"),
					'link'  => \dash\url::kingdom(). '/api/v1/privacy',
				],
				[
					'icon'  => 'list',
					'type'  => 'api',
					'title' => T_("Terms"),
					'link'  => \dash\url::kingdom(). '/api/v1/terms',
				],
			],
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'api',
			'title' => T_("Contact"),
			'link'  => \dash\url::kingdom(). '/api/v1/contact',
			'child' => null,
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'api',
			'title' => T_("Vision"),
			'link'  => \dash\url::kingdom(). '/api/v1/vision',
			'child' => null,
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'api',
			'title' => T_("Mission"),
			'link'  => \dash\url::kingdom(). '/api/v1/mission',
			'child' => null,
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'url',
			'title' => T_("Website"),
			'link'  => \dash\url::kingdom(),
			'child' => null,
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
			'title'       => T_(\dash\option::config('site','title')),
			'desc'        => T_(\dash\option::config('site','desc')),
			'bg_from'     => '#ffffff',
			'bg_to'       => '#ffffff',
			'title_color' => '#000000',
			'desc_color'  => '#000000',
			'image'       => self::logo_url(),
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
			'image'       => self::logo_url(),
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
			'image'       => self::logo_url(),
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
			'image'       => self::logo_url(),
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
		$homepage[]         = self::bottonLine();
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
		$homepage[]         = self::tile(5);

		$homepage[]         = self::banner();


		$homepage[]         = self::products();
		$homepage[]         = self::btnTile();
		$homepage[]         = self::text();



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
			"image"    => self::sample_image('09'),
			"url"      => '/product/2kf',
			"activity" => "product",
			"mode"     => "api"
		];

		$data[] =
		[
			"image"    => self::sample_image('13'),
			"url"      => '/category/2kd',
			"activity" => "category",
			"mode"     => "api"
		];

		$data[] =
		[
			"image"    => self::sample_image('06'),
			"url"      => '/collection/2kn',
			"activity" => "collection",
			"mode"     => "api"
		];

		$data[] =
		[
			"image"    => self::sample_image('14'),
			"url"      => '/post/2ke',
			"activity" => "page",
			"mode"     => "api"
		];


		$data[] =
		[
			"image"    => self::sample_image('21'),
			"url"      => 'https://jibres.com/category/sample',
			"activity" => "category",
			"mode"     => "webview"
		];

		$data[] =
		[
			"image"    => self::sample_image('30'),
			"url"      => 'https://jibres.com/collection/sample',
			"activity" => "collection",
			"mode"     => "website"
		];

		$data[] =
		[
			"image"    => self::sample_image('14'),
			"url"      => 'tel:+989123456789',
			"activity" => "tel",
			"mode"     => "tel"
		];


		$data[] =
		[
			"image"    => self::sample_image('09'),
			"url"      => 'mail:info@jires.com',
			"activity" => "email",
			"mode"     => "email"
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
			"title"    => T_("Expensive"),
			"url"      => '/product/2kf',
			"activity" => "product",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Promotion"),
			"url"      => '/category/2kd',
			"activity" => "category",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Inexpensive"),
			"url"      => '/collection/2kn',
			"activity" => "collection",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Sample"),
			"url"      => '/post/2ke',
			"activity" => "page",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Expensive"),
			"url"      => '/product/2kf',
			"activity" => "product",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Promotion"),
			"url"      => '/category/2kd',
			"activity" => "category",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Inexpensive"),
			"url"      => '/collection/2kn',
			"activity" => "collection",
			"mode"     => "api"
		];

		$data[] =
		[
			"title"    => T_("Sample"),
			"url"      => '/post/2ke',
			"activity" => "page",
			"mode"     => "api"
		];

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
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product1",
			"firstPrice" => 1000,
			"discount"   => 300,
			"price"      => 700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product2",
			"firstPrice" => 2000,
			"discount"   => 300,
			"price"      => 1700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product3",
			"firstPrice" => 3000,
			"discount"   => 300,
			"price"      => 2700,
			"unit"       => "$"
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product4",
			"firstPrice" => 4000,
			"discount"   => 300,
			"price"      => 3700,
			"unit"       => "$"
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product5",
			"firstPrice" => 5000,
			"discount"   => 300,
			"price"      => 4700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('30'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product6",
			"firstPrice" => 6000,
			"discount"   => 300,
			"price"      => 5700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('09'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product1",
			"firstPrice" => 1000,
			"discount"   => 300,
			"price"      => 700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product2",
			"firstPrice" => 2000,
			"discount"   => 300,
			"price"      => 1700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product3",
			"firstPrice" => 3000,
			"discount"   => 300,
			"price"      => 2700,
			"unit"       => "$"
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product4",
			"firstPrice" => 4000,
			"discount"   => 300,
			"price"      => 3700,
			"unit"       => "$"
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product5",
			"firstPrice" => 5000,
			"discount"   => 300,
			"price"      => 4700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('30'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product6",
			"firstPrice" => 6000,
			"discount"   => 300,
			"price"      => 5700,
			"unit"       => T_("Toman"),
		];



		$promotion['data'] = $data;

		return $promotion;
	}

	// private static function banner()
	// {
	// 	$link             = [];
	// 	$link['type']     = 'banner';

	// 	$banner = [];
	// 	$link['image']    = self::sample_image('06');
	// 	$link['url']      = self::jibres_temp_url(). '/store';
	// 	$link['activity'] = "category";
	// 	$link['mode']     = "api";
	// 	return $link;
	// }

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
				"image"    => self::sample_image($rand[array_rand($rand)]),
				"url"      => 'https://jibres.com/collection/sample',
				"activity" => "collection",
				"mode"     => "website"
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
				"image"    => self::sample_image($rand[array_rand($rand)]),
				"url"      => 'https://jibres.com/collection/sample',
				"activity" => "collection",
				"mode"     => "website"
			];
		}

		$tile['data'] = $data;
		return $tile;
	}


	private static function products()
	{
		$products           = [];
		$products['type']   = 'products';
		$products['margin'] = 2;
		$products['desc'] =
		[
			"title"    => "Product group 1",
			"url"      => '/product/2kf',
			"link"     => 'View Full',
			"activity" => "product",
			"mode"     => "api",
		];

		$data = [];

		$data[] =
		[
			"image"      => self::sample_image('09'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product1",
			"firstPrice" => 1000,
			"discount"   => 300,
			"price"      => 700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product2",
			"firstPrice" => 2000,
			"discount"   => 300,
			"price"      => 1700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product3",
			"firstPrice" => 3000,
			"discount"   => 300,
			"price"      => 2700,
			"unit"       => "$"
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product4",
			"firstPrice" => 4000,
			"discount"   => 300,
			"price"      => 3700,
			"unit"       => "$"
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"title"      => "Product5",
			"firstPrice" => 5000,
			"discount"   => 300,
			"price"      => 4700,
			"unit"       => T_("Toman"),
		];

		$data[] =
		[
			"image"      => self::sample_image('30'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
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
			"image"      => self::sample_image('09'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"text"      => "Product1",

		];

		$data[] =
		[
			"image"      => self::sample_image('13'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"text"      => "Product2",
		];

		$data[] =
		[
			"image"      => self::sample_image('06'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"text"      => "Product3",
		];

		$data[] =
		[
			"image"      => self::sample_image('14'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"text"      => "Product4",
		];


		$data[] =
		[
			"image"      => self::sample_image('21'),
			"url"        => '/product/2kf',
			"activity"   => "product",
			"mode"       => "api",
			"text"      => "Product5",
		];


		$btnTile['data'] = $data;

		return $btnTile;
	}


	private static function text()
	{
		$text           = [];
		$text['type']   = 'text';
		$text['margin'] = 2;
		$text['justify'] = 'center'; // rigth // left
		$text['text']   = "Hello, Show this text to me. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod \ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo";


		return $text;

	}




	private static function logo_url()
	{
		return \dash\url::site(). '/static/img/logo/svg/Jibres-icon.svg';
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