<?php
namespace content_site\body\application;


class app1
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
			'title'        => T_("Application"),
			'options'      =>
			[
				'heading',
				'description',
				'file',
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
				'responsive' => ['responsive_device',],
			],
			'default'      =>
			[
				'heading'                  => T_("Application"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'to bottom left',
				'background_gradient_to'   => '#fa0076',
				'background_gradient_from' => '#3c0876',
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
			$html .= ' <a class="btn-link btn-sm" target="_blank" href="'. \lib\store::admin_url(). '/a/android/download">'. T_("Click here"). '</a>';
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