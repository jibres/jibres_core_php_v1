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
		];

		return $option;

	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[
				'image_count'             => 6,
				'radius'                  => 'lg',
				'magicbox_title_position' => 'inside',
				'magicbox_gap'            => 'sm',
				'image_random'            => 1,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => 'free',
				'container'               => '2xl',
				'background_pack'         => 'none',
			],
		];
	}



}
?>