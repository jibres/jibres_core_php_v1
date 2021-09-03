<?php
namespace lib\pagebuilder\tools;


class first_init
{
	private static $post_id   = null;
	private static $header_id = null;
	private static $footer_id = null;
	private static $body_id   = null;

	public static function init()
	{

		// add a post
		// fill the pagebuilder by tihs post
		// set post as homepage

		if(!self::add_post())
		{
			\dash\notif::clean();
			return false;
		}

		self::header();

		self::body();

		self::footer();

		self::menu();

		\dash\engine\process::continue();

		\lib\pagebuilder\tools\homepage::set_as_homepage(self::$post_id);

		\dash\notif::clean();
	}


	public static function add_post()
	{
		\dash\engine\process::continue();

		$post =
		[
			'title' => T_("Default Homepage"),
			'type'  => 'pagebuilder',
			'status' => 'publish',
		];

		$post_detail = \dash\app\posts\add::add($post, true);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			self::$post_id = $post_detail['post_id'];
			return true;
		}
		return false;

	}


	public static function header()
	{
		$result = \lib\pagebuilder\tools\add::header('h100', self::$post_id);

		if(isset($result['id']))
		{
			self::$header_id = $result['id'];
		}
	}


	public static function footer()
	{
		$result = \lib\pagebuilder\tools\add::footer('f100', self::$post_id);

		if(isset($result['id']))
		{
			self::$footer_id = $result['id'];
		}
	}



	private static function menu()
	{
		$menu1 = \lib\app\menu\add::add(['title' => T_("Example menu 1")]);

		$element = \lib\pagebuilder\tools\get::load_element('h100', self::$post_id, self::$header_id);

		if(isset($menu1['id']))
		{

			\lib\pagebuilder\tools\edit::edit($element, ['set_menu_header_menu_1' => true, 'header_menu_1' => $menu1['id']]);

			$menu_item1 =
			[
				'title'   => T_("About"),
				'url'     => '/about',
				'pointer' => 'other',
			];

			\lib\app\menu\add::menu_item($menu_item1, $menu1['id']);

			$menu_item2 =
			[
				'title'   => T_("Contact"),
				'url'     => '/contact',
				'pointer' => 'other',
			];

			\lib\app\menu\add::menu_item($menu_item2, $menu1['id']);
		}


		$menu2 = \lib\app\menu\add::add(['title' => T_("Example menu 2")]);

		if(isset($menu2['id']))
		{
			\lib\pagebuilder\tools\edit::edit($element, ['set_menu_header_menu_2' => true, 'header_menu_2' => $menu1['id']]);

			$menu_item1 =
			[
				'title'   => T_("Instagram"),
				'url'     => 'https://www.instagram.com/JibresDotCom/',
				'target'  => 'blank',
				'pointer' => 'other',
			];

			\lib\app\menu\add::menu_item($menu_item1, $menu2['id']);

			$menu_item2 =
			[
				'title'   => T_("Telegram"),
				'url'     => 'https://t.me/Jibres',
				'target'  => 'blank',
				'pointer' => 'other',
			];

			\lib\app\menu\add::menu_item($menu_item2, $menu2['id']);
		}

	}


	public static function body()
	{
		$slider = self::slider();

		\dash\temp::set('init_force_pagebuilder_detail', $slider);

		$result = \lib\pagebuilder\tools\add::body('image', self::$post_id);

		if(isset($result['id']))
		{
			self::$body_id = $result['id'];

		}

		$result = \lib\pagebuilder\tools\add::body('products', self::$post_id);
		if(isset($result['id']))
		{
			self::$body_id = $result['id'];

		}


		$result = \lib\pagebuilder\tools\add::body('news', self::$post_id);
		if(isset($result['id']))
		{
			self::$body_id = $result['id'];

		}


		\dash\notif::clean();
	}


	public static function slider()
	{
		$slider = [];


		$list = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40];
		$list_image = array_rand($list, 6);
		foreach ($list_image as $key => $index)
		{
			$slider[] =
			[
				"image"  => \dash\url::cdn(). "/images/slider-sample/food/". $list[$index].".jpg",
				"url"    => null,
				"alt"    => T_("Image :val", ['val' => \dash\fit::number($key + 1)]),
				"sort"   => null,
				"target" => null
			];
		}

		$detail =
		[
			'list' => $slider,
  		];

  		$detail = json_encode($detail, JSON_UNESCAPED_UNICODE);

  		return $detail;

	}
}
?>