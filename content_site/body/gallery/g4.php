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

		$myKey = array_search('container_gallery', $option['options']['style']);
		$option['options']['style'] = array_replace($option['options']['style'], [$myKey => 'container_gallery_g4']);


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
				'image_count'             => 7,
				'slider_pagination'       => 1,
				'slider_next_prev'        => 1,
				'slider_effect'           => 'slide',
				'slider_autoplay'         => 5,
				'radius'                  => 'lg',
				'magicbox_title_position' => 'hide',
				'magicbox_gap'            => 'sm',
				'link_color'              => 'light',
				'image_random'            => 1,
				'height'                  => 'sm',
				'effect'                  => 'zoom',
				'coverratio'              => '16:9',
				'container'               => 'xl',
				'background_pack'         => 'none',
				'background_color'        => '#8ea4c8',
			],
		];
	}



}
?>