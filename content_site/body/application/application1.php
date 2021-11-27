<?php
namespace content_site\body\application;


class application1
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
			'title'        => T_("application 1"),
			'options'      =>
			[
				'heading',
				'description',
				'msg' => 'manage',


				'style' => \content_site\utility::set_style_option(
				[
					'font',

					'radius_full',
					'background_pack',
					'color_heading',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container',
				],
				'responsive' => \content_site\utility::set_responsive_option(),
			],
			'default'      =>
			[
				'heading'              => T_("Application"),
				'height'               => 'fullscreen',
				'use_as_heading'       => 'business_heading',
				'use_as_description'   => 'business_description',
				'background_pack'      => 'solid',
				'background_color'     => '#eeeeee',
			],
			'preview_list' =>
			[
				'p1',
				'p2'
			],
		];
	}


	public static function manage()
	{
		$html = '';
		$html .= '<div class="alert2 mt-3">';
		{
			$html .= T_("To manage application download links");
			$html .= ' <a class="btn-link btn-sm" href="'. \lib\store::admin_url(). '/a/android/download">'. T_("Click here"). '</a>';
		}
		$html .= '</div>';
		return $html;
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
				'radius'               => 'full',

			],
		];
	}



}
?>