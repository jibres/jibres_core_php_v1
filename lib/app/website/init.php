<?php
namespace lib\app\website;

class init
{

	/**
	 * After create new business call this function to init first detail
	 */
	public static function first_init()
	{
		self::status();
		self::header();
		self::body();
		self::footer();
		self::menu();
	}


	public static function status()
	{
		\lib\app\website\status\set::status(['status' => 'publish']);
		\lib\app\website\generator::remove_catch();
		\dash\notif::clean();
	}


	public static function header()
	{
		\lib\app\website\header\set::set_header_template(['header' => 'header_100']);
		\lib\app\website\generator::remove_catch();
		\dash\notif::clean();
	}


	public static function footer()
	{
		\lib\app\website\footer\set::set_footer_template(['footer' => 'footer_100']);
		\lib\app\website\generator::remove_catch();
		\dash\notif::clean();
	}



	private static function menu()
	{
		$menu1 = \lib\app\website\menu\add::new_menu(['title' => T_("Example menu 1")]);

		if(isset($menu1['id']))
		{

			$customize_header = \lib\app\website\header\set::customize_header(['header_menu_1' => $menu1['key']]);

			$menu_item1 =
			[
				'title' => T_("About"),
				'url'   => '/about',
			];

			\lib\app\website\menu\add::menu_item($menu_item1, $menu1['id']);

			$menu_item2 =
			[
				'title' => T_("Contact"),
				'url'   => '/contact',
			];

			\lib\app\website\menu\add::menu_item($menu_item2, $menu1['id']);
		}


		$menu2 = \lib\app\website\menu\add::new_menu(['title' => T_("Example menu 2")]);

		if(isset($menu2['id']))
		{
			$customize_header = \lib\app\website\header\set::customize_header(['header_menu_2' => $menu2['key']]);

			$menu_item1 =
			[
				'title'  => T_("Instagram"),
				'url'    => 'https://www.instagram.com/JibresDotCom/',
				'target' => 1,
			];

			\lib\app\website\menu\add::menu_item($menu_item1, $menu2['id']);

			$menu_item2 =
			[
				'title'  => T_("Telegram"),
				'url'    => 'https://t.me/Jibres',
				'target' => 1,
			];

			\lib\app\website\menu\add::menu_item($menu_item2, $menu2['id']);
		}

	}


	public static function body()
	{
		self::slider();
		$post =
		[
			'title'   => T_("Latest products"),
			'publish' => 1,
			'type'    => 'latestproduct',
			'cat_id'  => null,
		];
		$productline = \lib\app\website\body\line\productline::add($post);

		$post =
		[
			'title'   => T_("Random products"),
			'publish' => 1,
			'type'    => 'randomproduct',
			'cat_id'  => null,
		];

		$productline = \lib\app\website\body\line\productline::add($post);

		\lib\app\website\generator::remove_catch();

		\dash\notif::clean();
	}


	public static function slider()
	{
		$slider = [];
		// if(\dash\language::current() === 'fa')
		// {
		// 	$list = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,];
		// 	$list_image = array_rand($list, 6);

		// 	foreach ($list_image as $key => $index)
		// 	{
		// 		$slider[] =
		// 		[
		// 			"image"  => \dash\url::cdn(). "/images/slider-sample/iran/". $list[$index].".jpg",
		// 			"url"    => null,
		// 			"alt"    => null,
		// 			"sort"   => null,
		// 			"target" => null
		// 		];
		// 	}

		// }
		// else
		// {
		// 	$list = [1,2,3,4,5,6,7,8,9,10,11,12,13,];
		// 	$list_image = array_rand($list, 6);
		// 	foreach ($list_image as $key => $index)
		// 	{
		// 		$slider[] =
		// 		[
		// 			"image"  => \dash\url::cdn(). "/images/slider-sample/international/". $list[$index].".jpg",
		// 			"url"    => null,
		// 			"alt"    => null,
		// 			"sort"   => null,
		// 			"target" => null
		// 		];
		// 	}

		// }

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

		$value =
		[

			"title"         => T_("Special Slider"),
			"type"          => "specialslider",
			"ratio"         => null,
			"sort"          => null,
			"publish"       => 1,
			"specialslider" => $slider,
  		];



  		$value = json_encode($value, JSON_UNESCAPED_UNICODE);
		$lang = \dash\language::current();
		$cat  = 'homepage';
		$key  = 'body_line_specialslider';

  		$insert =
  		[
			'platform' => 'website',
			'cat'      => $cat,
			'key'      => $key,
			'value'    => $value,
			'lang'     => $lang,
  		];

  		$id = \lib\db\setting\insert::new_record($insert);

  		\lib\app\website\generator::remove_catch();

  		$id = \dash\coding::encode($id);
  		return $id;

	}
}
?>