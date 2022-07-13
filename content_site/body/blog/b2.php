<?php
namespace content_site\body\blog;


class b2
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{

		return
		[
			'title'        => T_("Magic Box"),
			'options'      =>
			[
				'heading',
				'post_tag',
				'post_template',
				'post_order',
				'count_post',
				'magicbox_title_position',
				'btn_viewall',
				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'justify_heading',
					'heading_size',
					'color_heading',
					'radius_full',
					'coverratio',
					'effect',
					'image_mask',
					'link_color_magicbox_title',
					'btn_viewall_mode',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container',
					'magicbox_gap',
				],
				'responsive' =>
				[
					'responsive_device',
					'responsive_layout',
				],
			],
			'default'      =>
			[
				'heading'                   => T_("Latest Posts"),
				'post_template'             => 'any',
				'post_order'                => 'latest',
				'count'                     => 3,
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'height'                    => 'md',
				'coverratio'                => '16:9',
				'magicbox_gap'              => 'sm',
				'color_text'                => '#333333',
				'heading_position'          => 'center',
				'btn_viewall_mode'          => 'dark',
				'radius'                    => 'lg',
				'magicbox_title_position'   => 'inside',
				'effect'                    => 'zoom',
				'link_color_magicbox_title' => 'light'
			],
			'preview_list' =>
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
				'p12',
			],
		];
	}


	/**
	 * Preview list
	 */



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'count'                     => 12,
				'color_text'                => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p1




	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p2
	 *
	*/
	public static function p2()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '3:1',
				'count'                     => 10,
				'color_text'                => '#333333',
				'color_heading'             => '#0173cb',
				'btn_viewall_mode'          => 'primary',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_color'          => '#e5faff',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p2


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p3
	 *
	*/
	public static function p3()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 8,
				'color_text'                => '#333333',
				'color_heading'             => '#000000',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_color'          => '#dcdbd9',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p3


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p4
	 *
	*/
	public static function p4()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '3:4',
				'count'                     => 4,
				'color_text'                => '#333333',
				'color_heading'             => '#000000',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#c4c2d0',
				'background_gradient_from'  => '#bce2e6',
				'background_color'          => '#dcdbd9',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p4


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p5
	 *
	*/
	public static function p5()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 4,
				'color_text'                => '#333333',
				'color_heading'             => '#d7bf1d',
				'btn_viewall_mode'          => 'light',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#000000',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p5


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p6
	 *
	*/
	public static function p6()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'squircle',
				'height'                    => 'auto',
				'heading_position'          => 'left',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 8,
				'color_text'                => '#333333',
				'color_heading'             => '#000000',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => null,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#f4c815',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p6


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p7
	 *
	*/
	public static function p7()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'hide',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'heart',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'light',
				'coverratio'                => '1:1',
				'count'                     => 1,
				'color_text'                => '#333333',
				'color_heading'             => '#ff1493',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => null,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#ffc0cb',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p7


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p8
	 *
	*/
	public static function p8()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'hexagon-2',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'count'                     => 3,
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_mode'          => 'light',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#1663a9',
				'background_gradient_from'  => '#0ff53b',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p8


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p9
	 *
	*/
	public static function p9()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'hide',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => null,
				'effect'                    => 'none',
				'coverratio'                => '1:1',
				'count'                     => 3,
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_mode'          => 'light',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#e6a691',
				'background_gradient_from'  => '#915118',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p9


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:02
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p10
	 *
	*/
	public static function p10()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'parallelogram-4',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '1:1',
				'count'                     => 4,
				'color_text'                => '#333333',
				'color_heading'             => '#ffffff',
				'btn_viewall_mode'          => 'light',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'gradient',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#674c4b',
				'background_gradient_from'  => '#1f1004',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p10


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:02
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p11
	 *
	*/
	public static function p11()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'outside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'secondary',
				'image_mask'                => 'none',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'count'                     => 7,
				'color_text'                => '#333333',
				'color_heading'             => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'none',
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#0db8d9',
				'background_gradient_from'  => '#0b2365',
				'background_color'          => '#8fa2a6',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p11


	/**
	 * Auto Generate Function
	 * @date 2022-07-13 18:04:02
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/blog/b2.php
	 * body / blog / b2 / p12
	 *
	*/
	public static function p12()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'radius'                    => 'lg',
				'post_show_image'           => true,
				'magicbox_title_position'   => 'inside',
				'magicbox_gap'              => 'sm',
				'link_color_magicbox_title' => 'light',
				'link_color'                => 'light',
				'image_mask'                => 'none',
				'height'                    => 'auto',
				'heading_position'          => 'center',
				'heading'                   => T_("Latest Posts"),
				'effect'                    => 'dark',
				'coverratio'                => '16:9',
				'count'                     => 6,
				'color_text'                => '#333333',
				'color_heading'             => '#333333',
				'btn_viewall_mode'          => 'dark',
				'btn_viewall_check'         => true,
				'btn_viewall'               => T_("View all"),
				'background_pack'           => 'solid',
				'background_image'          => null,
				'background_gradient_type'  => 'to bottom right',
				'background_gradient_to'    => '#0db8d9',
				'background_gradient_from'  => '#0b2365',
				'background_color'          => '#eeeeee',
			],
		];
	}
	// path content_site/body/blog/b2.php
	// body / blog / b2 / p12

}
?>