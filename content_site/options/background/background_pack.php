<?php
namespace content_site\options\background;


class background_pack
{

	/**
	 * Everywhere need backgroun pack option use this function
	 *
	 * @return     array  The pack option list.
	 */
	public static function get_pack_option_list()
	{
		return
		[
			'background_pack',

			// skip draw this option in html

			'background_color',
			'background_opacity',
			'background_position',
			'background_repeat',
			'background_size',

			'file',

			'background_gradient',
			'background_gradient_from',
			'background_gradient_via',
			'background_gradient_to',
			'background_gradient_type',
			'background_gradient_attachment',

			'video',
		];

	}




	/**
	 * Get all class in backgroun
	 *
	 * @param      <type>  $_data  The backgroun pack array
	 */
	public static function get_full_backgroun_class($_data)
	{
		$pack    = a($_data, 'background_pack');

		$class   = [];
		$attr    = [];
		$element = null;

		switch ($pack)
		{
			case 'solid';
				if(!a($_data, 'background_color'))
				{
					$_data['background_color'] = background_color::default();
				}

				$class[] = 'bg-'. $_data['background_color'];
				break;

			case 'image';

				// background file
				if(a($_data, 'file'))
				{
					$attr[] = 'style="background-image: url('.\lib\filepath::fix($_data['file']).')"';
				}

				// backgroun repreat
				if(!a($_data, 'background_repeat'))
				{
					$_data['background_repeat'] = background_repeat::default();
				}

				$class[] = 'bg-'. $_data['background_repeat'];


				// backgroun attachemnt
				if(!a($_data, 'background_attachment'))
				{
					$_data['background_attachment'] = background_attachment::default();
				}

				$class[] = 'bg-'. $_data['background_attachment'];

				// backgroun position
				if(!a($_data, 'background_position'))
				{
					$_data['background_position'] = background_position::default();
				}

				$class[] = 'bg-'. $_data['background_position'];


				// backgroun size
				if(!a($_data, 'background_size'))
				{
					$_data['background_size'] = background_size::default();
				}

				$class[] = 'bg-'. $_data['background_size'];
				break;

			case 'gradient';
				// backgroun gradient type
				if(!a($_data, 'background_gradient_type'))
				{
					$_data['background_gradient_type'] = background_gradient_type::default();
				}

				$class[] = 'bg-'. $_data['background_gradient_type'];

				// backgroun gradient from
				if(!a($_data, 'background_gradient_from'))
				{
					$_data['background_gradient_from'] = background_gradient_from::default();
				}

				$class[] = 'from-'. $_data['background_gradient_from'];

				// backgroun gradient via
				if(!a($_data, 'background_gradient_via'))
				{
					$_data['background_gradient_via'] = background_gradient_via::default();
				}

				$class[] = 'via-'. $_data['background_gradient_via'];


				// backgroun gradient to
				if(!a($_data, 'background_gradient_to'))
				{
					$_data['background_gradient_to'] = background_gradient_to::default();
				}

				$class[] = 'to-'. $_data['background_gradient_to'];

				break;


			case 'video';
				// background video
				if(a($_data, 'video'))
				{
					$element .= '<style type="text/css">#page_background_video { right: 0;  bottom: 0;  min-width: 100%;  min-height: 100%; }</style>';
					$element .= '<video playsinline autoplay muted loop  id="page_background_video">';
					{
						$element .= '<source src="'.\lib\filepath::fix($_data['video']).'" type="video/mp4">';
					}
					$element .= '</video>';
				}
				break;

			case 'none';
			default:
				// no backgroun class
				return null;
				break;
		}

		if(!a($_data, 'background_opacity'))
		{
			$_data['background_opacity'] = background_opacity::default();
		}

		$class[] = 'bg-opacity-'. $_data['background_opacity'];

		return
		[
			'class'   => implode(' ', $class),
			'attr'    => implode(' ', $attr),
			'element' => $element,
		];
	}



	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => ['none', 'solid', 'gradient', 'image', 'video'], 'field_title' => T_('Background Pack')]);
		return $data;
	}


	public static function default()
	{
		return 'none';
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_pack');

		if(!$default)
		{
			$default = self::default();
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


		$html .= '<div data-response="opt_background_gradient" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
		{
			$default_gradient = background_gradient::template_or_custom(...func_get_args());

			$html .= '<div class="row">';
			{
				$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="gradient_custom" value="template" id="background_pack_template" '.(($default_gradient === 'template') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_template">Template</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-12 c-sm-12 c-md-6 mt-5">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="gradient_custom" value="custom" id="background_pack_custom" '.(($default_gradient === 'custom') ? "checked" : null ).'>';
						$html .= '<label for="background_pack_custom">Costom</label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= '<div data-response="gradient_custom" data-response-where="template" '.(($default_gradient === 'template') ? null : 'data-response-hide').'>';
			{
				$html .= background_gradient::admin_html(...func_get_args());
			}
			$html .= '</div>';

			$html .= '<div data-response="gradient_custom" data-response-where="custom" '.(($default_gradient === 'custom') ? null : 'data-response-hide').'>';
			{

				$html .= background_gradient_from::admin_html(...func_get_args());
				$html .= background_gradient_via::admin_html(...func_get_args());
				$html .= background_gradient_to::admin_html(...func_get_args());
				$html .= background_gradient_type::admin_html(...func_get_args());
			}
			$html .= '</div>';

		}
		$html .= '</div>';

		$html .= '<div data-response="opt_background_pack" data-response-where="image" '.(($default === 'image') ? null : 'data-response-hide').'>';
		{
			$html .= \content_site\options\file::admin_html(...func_get_args());
			$html .= background_attachment::admin_html(...func_get_args());
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