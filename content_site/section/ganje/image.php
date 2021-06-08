<?php
namespace content_site\section\ganje;


class image
{

	public static function allow()
	{
		return true;
	}


	public static function detail()
	{

		$detail =
		[
			'group' => T_("Image"),
			'title' => T_("Image Gallery"),
			'key'   => 'image',
			'icon'  => \dash\utility\icon::url('images'),
		];

		return $detail;
	}


	public static function options()
	{
		$options =
		[
			'imagelist' =>
			[
				'file',
				// 'title',
				// 'url',
				// 'target',
			],
			'addimage',
			'heading',
			'avand',
			'padding',
			'radius',

		];

		return $options;
	}


	public static function default()
	{
		$default =
		[
			'heading'        => T_("Image Gallery"),
		];

		return $default;
	}


	/**
	 * Layout image html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = '';

		$html .= '<div class="'. a($_args, 'avand').'">';
		{
			$html .= '<div class="">';
			{
				$html .= '<div class="">';
				{
					$html .= '<h2>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h2>';

				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';


		return $html;
	}
}
?>