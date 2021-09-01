<?php
namespace content_site\body\gallery;


class g3
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		$option                           = g2::option();
		$option['title']                  = T_("2 Magic Box + Slider");

		$option['maximum_capacity']       = 14;
		$option['minimum_item']           = 4;
		$option['break_image_list']       = 2;

		$option['default']['image_count'] = 12;

		$option['preview_list']           =
		[
				'p1',
				'p2',
				'p3',
				'p4',
				'p5',
				'p6',
				'p7',
				'p8',
				'p9',
				'p10',
				'p11',
		];

		return $option;
	}


	public static function p1()
	{
		$preview = g2::p1();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p2()
	{
		$preview = g2::p2();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p3()
	{
		$preview = g2::p3();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p4()
	{
		$preview = g2::p4();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p5()
	{
		$preview = g2::p5();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p6()
	{
		$preview = g2::p6();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p7()
	{
		$preview = g2::p7();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p8()
	{
		$preview = g2::p8();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p9()
	{
		$preview = g2::p9();
		$preview['options']['image_count'] = 5;

		return $preview;
	}


	public static function p10()
	{
		$preview = g2::p10();
		$preview['options']['image_count'] = 5;

		return $preview;
	}

	public static function p11()
	{
		$preview = g2::p11();
		$preview['options']['image_count'] = 5;

		return $preview;
	}
}
?>