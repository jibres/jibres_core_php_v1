<?php
namespace content_api\v2\app;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}


	public static function api_routing()
	{
		if(!\dash\request::is('get'))
		{
			\content_api\v2::invalid_method();
		}

		$detail = self::detail_v2();

		\content_api\v2::say($detail);
	}



	private static function detail_v2()
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
				$lang_list[$key]['api_url'] = \dash\url::base().'/'. $key .'/api/v2';
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
					'link'  => \dash\url::kingdom(). '/api/v2/about',
				],
				[
					'icon'  => 'lock',
					'type'  => 'api',
					'title' => T_("Privacy"),
					'link'  => \dash\url::kingdom(). '/api/v2/privacy',
				],
				[
					'icon'  => 'list',
					'type'  => 'api',
					'title' => T_("Terms"),
					'link'  => \dash\url::kingdom(). '/api/v2/terms',
				],
			],
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'api',
			'title' => T_("Contact"),
			'link'  => \dash\url::kingdom(). '/api/v2/contact',
			'child' => null,
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'api',
			'title' => T_("Vision"),
			'link'  => \dash\url::kingdom(). '/api/v2/vision',
			'child' => null,
		];

		$menu[] =
		[
			'icon'  => null,
			'type'  => 'api',
			'title' => T_("Mission"),
			'link'  => \dash\url::kingdom(). '/api/v2/mission',
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
		$homepage[]         = self::btns();
		$homepage[]         = self::tile();
		$homepage[]         = self::promotion();
		$homepage[]         = self::banner();
		$homepage[]         = self::btn4();
		$homepage[]         = self::list();


		$detail['homepage'] = $homepage;
	}


	private static function slider()
	{
		$slider           = [];
		$slider['type']   = 'slider';
		// $posts          = \dash\app\posts::get_post_list(['special' => 'slider', 'limit' => 5]);
		$post = [];

		$post[] =
		[
			'image' => 'https://source.jibres.com/static/img/cover/Jibres-cover-fa-1.jpg',
			'url'   => 'https://source.jibres.com/',
		];

		$slider['slider'] = $post;

		return $slider;
	}


	private static function btns()
	{
		$btns           = [];
		$btns['type']   = 'btns';
		// $posts          = \dash\app\posts::get_post_list(['special' => 'btns', 'limit' => 5]);
		$post = [];

		$post[] =
		[
			'image' => 'https://source.jibres.com/static/img/cover/Jibres-cover-fa-1.jpg',
			'url'   => 'https://source.jibres.com/',
		];

		$btns['btns'] = $post;

		return $btns;
	}


	private static function tile()
	{
		$tile           = [];
		$tile['type']   = 'tile';
		// $posts          = \dash\app\posts::get_post_list(['special' => 'tile', 'limit' => 5]);
		$post = [];

		$post[] =
		[
			'image' => 'https://source.jibres.com/static/img/cover/Jibres-cover-fa-1.jpg',
			'url'   => 'https://source.jibres.com/',
		];

		$tile['tile'] = $post;

		return $tile;
	}


	private static function promotion()
	{
		$promotion           = [];
		$promotion['type']   = 'promotion';
		$promotion['expire']   = date("Y-m-d H:i:s", time() + 3600);
		// $posts          = \dash\app\posts::get_post_list(['special' => 'promotion', 'limit' => 5]);
		$post = [];

		$post[] =
		[
			'image' => 'https://source.jibres.com/static/img/cover/Jibres-cover-fa-1.jpg',
			'url'   => 'https://source.jibres.com/',
		];

		$promotion['promotion'] = $post;

		return $promotion;
	}

	private static function list()
	{
		$list           = [];
		$list['type']   = 'list';
		// $posts          = \dash\app\posts::get_post_list(['special' => 'list', 'limit' => 5]);
		$post = [];

		$post[] =
		[
			'image' => 'https://source.jibres.com/static/img/cover/Jibres-cover-fa-1.jpg',
			'url'   => 'https://source.jibres.com/',
		];

		$list['list'] = $post;

		return $list;
	}

	private static function banner()
	{
		$link          = [];
		$link['type']  = 'banner';
		$link['image'] = 'https://source.jibres.com/static/img/cover/Jibres-cover-fa-1.jpg';
		$link['url']   = self::jibres_temp_url(). '/store';
		return $link;
	}




	private static function btn4()
	{
		$link                     = [];
		$link['type']             = 'btn4';

		$link['link'][0]['image'] = self::logo_url();
		$link['link'][0]['url']   = self::jibres_temp_url();
		$link['link'][0]['text']  = T_('Home');


		$link['link'][1]['image'] = self::logo_url();
		$link['link'][1]['url']   = \dash\url::support();
		$link['link'][1]['text']  = T_('Support');


		$link['link'][2]['image'] = self::logo_url();
		$link['link'][2]['url']   = self::jibres_temp_url(). '/store';
		$link['link'][2]['text']  = T_('Store');


		$link['link'][3]['image'] = self::logo_url();
		$link['link'][3]['url']   = self::jibres_temp_url(). '/enter';
		$link['link'][3]['text']  = T_('Enter');

		return $link;
	}

	private static function logo_url()
	{
		return 'https://source.jibres.com/static/img/logo/svg/Jibres-icon.svg';
	}

	private static function jibres_temp_url()
	{
		return 'https://jeebres.com';
	}



	private static function news()
	{
		$link         = [];
		$link['type'] = 'news';
		$posts        = \dash\app\posts::get_post_list(['limit' => 3, 'language' => \dash\language::current()]);
		$link['news'] = $posts;
		return $link;
	}


	private static function hr()
	{
		$link          = [];
		$link['type']  = 'hr';
		return $link;
	}



	private static function title($_title = null)
	{
		$link          = [];
		$link['type']  = 'title';
		$link['title'] = $_title ? $_title : T_("Hi!");
		return $link;
	}



}
?>