<?php
namespace content_site\options\background;


class background_pack
{

	public static function contain_option()
	{
		return
		[
			'background_color',
			'background_opacity',
			'background_position',
			'background_repeat',
			'background_size',

			'file',
			'background_gradient_from',
			'background_gradient_via',
			'background_gradient_to',
			'background_gradient_type',
		];
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_pack');

		if(!$default)
		{
			$default = self::default();
		}

		$color_ajax = \dash\url::here(). '/color?json=1';

		$title = T_("Background");

		$background_opacity = "<label for='background_opacity'>Opacity</label>";
		$background_opacity .= '<select name="background_opacity" class="select22" data-model="ajax" data-ajax--url="'.$color_ajax.'" data-ajax--cache="true" id="background_opacity">';
		$background_opacity .= '</select>';

		$html = '';



		$html .= "<label for='background_pack'>Background Type</label>";

		$html .= '<div class="row">';
		{
			$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
			{
				$html .= '<div class="radio3">';
				{
					$html .= '<input type="radio" name="background_type" value="none" id="background_type_none">';
					$html .= '<label for="background_type_none">None</label>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
			{
				$html .= '<div class="radio3">';
				{
					$html .= '<input type="radio" name="background_type" value="solid" id="background_type_solid">';
					$html .= '<label for="background_type_solid">Solid</label>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
			{
				$html .= '<div class="radio3">';
				{
					$html .= '<input type="radio" name="background_type" value="gradient" id="background_type_gradient">';
					$html .= '<label for="background_type_gradient">Gradient</label>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
			{
				$html .= '<div class="radio3">';
				{
					$html .= '<input type="radio" name="background_type" value="image" id="background_type_image">';
					$html .= '<label for="background_type_image">Image</label>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		$html .= '<div data-response="background_type" data-response-where="solid" data-response-hide>';
		{
			$html .= background_color::admin_html(...func_get_args());
			$html .= background_opacity::admin_html(...func_get_args());
		}
		$html .= '</div>';

		$html .= '<div data-response="background_type" data-response-where="gradient" data-response-hide>';
		{
			// $html .= background_color::admin_html(...func_get_args());
			// $html .= background_opacity::admin_html(...func_get_args());
		}
		$html .= '</div>';

		$html .= '<div data-response="background_type" data-response-where="image" data-response-hide>';
		{
			$html .= \content_site\options\file::admin_html(...func_get_args());
			// $html .= background_opacity::admin_html(...func_get_args());

		}
		$html .= '</div>';

		return $html;
	}

}
?>