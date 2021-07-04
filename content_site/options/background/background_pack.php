<?php
namespace content_site\options\background;


class background_pack
{

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => ['none', 'solid', 'gradient', 'image', 'video'], 'field_title' => T_('Background Type')]);
		return $data;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_pack');

		if(!$default)
		{
			$default = 'solid';
		}



		$title = T_("Background");

		$html = '';


		$html .= "<label for='background_pack'>Background Type</label>";

		$html .= '<form method="post" data-patch>';
		{
			// $html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<div class="row">';
			{
				$html .= '<div class="c-xs-12 c-sm-12 c-md-4 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="opt_background_pack" value="none" id="background_pack_none" '.(($default === 'none') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_none">None</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-12 c-sm-12 c-md-4 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="opt_background_pack" value="solid" id="background_pack_solid" '.(($default === 'solid') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_solid">Solid</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-12 c-sm-12 c-md-4 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="opt_background_pack" value="gradient" id="background_pack_gradient" '.(($default === 'gradient') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_gradient">Gradient</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="opt_background_pack" value="image" id="background_pack_image" '.(($default === 'image') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_image">Image</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="opt_background_pack" value="video" id="background_pack_video" '.(($default === 'video') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_video">Video</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</form>';


		$html .= '<div data-response="opt_background_pack" data-response-where="solid" '.(($default === 'solid') ? null : 'data-response-hide').'>';
		{
			$html .= background_color::admin_html(...func_get_args());
		}
		$html .= '</div>';

		$html .= '<div data-response="opt_background_pack" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
		{
			$html .= background_gradient_from::admin_html(...func_get_args());
			$html .= background_gradient_via::admin_html(...func_get_args());
			$html .= background_gradient_to::admin_html(...func_get_args());
			$html .= background_gradient_type::admin_html(...func_get_args());
		}
		$html .= '</div>';

		$html .= '<div data-response="opt_background_pack" data-response-where="image" '.(($default === 'image') ? null : 'data-response-hide').'>';
		{
			$html .= \content_site\options\file::admin_html(...func_get_args());
			$html .= background_position::admin_html(...func_get_args());
			$html .= background_repeat::admin_html(...func_get_args());
			$html .= background_size::admin_html(...func_get_args());
		}
		$html .= '</div>';

		$html .= '<div data-response="opt_background_pack" data-response-where="video" '.(($default === 'video') ? null : 'data-response-hide').'>';
		{
			$html .= \content_site\options\video::admin_html(...func_get_args());
		}
		$html .= '</div>';

		$html .= '<div data-response="opt_background_pack" data-response-where="image|solid|gradient|video" '.((in_array($default, ['image','solid','gradient','video'])) ? null : 'data-response-hide').'>';
		{
			$html .= background_opacity::admin_html(...func_get_args());
		}
		$html .= '</div>';

		return $html;
	}

}
?>