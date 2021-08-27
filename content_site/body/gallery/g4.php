<?php
namespace content_site\body\gallery;


class g4
{
		/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		$option                           = g2::option();
		$option['title']                  = T_("Slider");

		$option['maximum_capacity']       = 14;
		$option['minimum_item']           = 4;
		$option['default']['image_count'] = 12;
		unset($option['break_image_list']);

		$myKey = array_search('slider_effect', $option['options']['slider_setting']);
		$option['options']['slider_setting'] = array_replace($option['options']['slider_setting'], [$myKey => 'slider_effect_full']);

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