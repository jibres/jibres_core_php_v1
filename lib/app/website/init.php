<?php
namespace lib\app\website;

class init
{
	public static function status()
	{
		\lib\app\website\status\set::status(['status' => 'publish']);
		\dash\notif::clean();
	}


	public static function header()
	{
		\lib\app\website\header\set::set_header_template(['header' => 'header_100']);
		\dash\notif::clean();
	}


	public static function footer()
	{
		\lib\app\website\footer\set::set_footer_template(['footer' => 'footer_100']);
		\dash\notif::clean();
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
				"alt"    => null,
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

  		$id = \dash\coding::encode($id);
  		return $id;

	}
}
?>