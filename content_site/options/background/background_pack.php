<?php
namespace content_site\options\background;


class background_pack
{
	private static $remove_from_list = [];
	private static $current_options = [];


	public static function remove_from_list($_index)
	{
		if(!in_array($_index, self::$remove_from_list))
		{
			self::$remove_from_list[] = $_index;
		}
	}


	/**
	 * Set current background pack
	 *
	 * @param      <type>  $_option_list  The option list
	 */
	public static function current_background_pack_option($_option_list)
	{
		self::$current_options = $_option_list;
	}


	public static function enum()
	{
		return ['none', 'solid', 'gradient', 'image', 'video'];
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => self::enum(), 'field_title' => T_('Background Pack')]);

		$result                    = [];

		$result['background_pack'] = $data;

		$current = \content_site\section\view::get_current_index_detail();

		switch ($data)
		{
			case 'solid':
				if(!a($current, 'background_color'))
				{
					$result = array_merge($result, background_color_random::postel_color_solid());
					\content_site\utility::need_redirect(true);
				}
				break;
			case 'gradient':
				if(!a($current, 'background_gradient_from'))
				{
					$result = array_merge($result, background_color_random::gradient_sample_color());
					\content_site\utility::need_redirect(true);
				}
				break;

			case 'image':
				if(!a($current, 'background_image'))
				{
					$result['background_image'] = \dash\sample\img::background();
					\content_site\utility::need_redirect(true);
				}
				break;

			default:
				// nothing
				break;
		}

		return $result;
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

		$func_get_args = func_get_args();

		$html = '';


		$current_style = a($_section_detail, 'preview');

		if(!is_array($current_style))
		{
			$current_style = [];
		}

		$html .= \content_site\options\height::admin_html();

		// not removed from background
		if(!in_array('coverratio', self::$remove_from_list))
		{
			$html .= \content_site\options\coverratio::admin_html();
		}

		if(in_array('btn_viewall_mode', self::$current_options))
		{
			$html .= \content_site\options\btn\btn_viewall::admin_html_viewall_mode();
		}

		if(in_array('link_mode', self::$current_options))
		{
			$html .= \content_site\options\link\link_mode::admin_html();
		}

		$html .= "<div class='ShowCustomizeSetting'>";
		{
			$html .= \content_site\options\font::admin_html();
			$html .= \content_site\options\color\color_text::admin_html();

			$html .= '<form method="post" class="mb-5 mT0-f" data-patch>';
			{

				$html .= '<input type="hidden" name="notredirect" value="1">';
				$html .= "<label>". T_("Background Type") ."</label>";

				$name       = 'opt_background_pack';

				$radio_html = '';
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'none', T_('Transparent'), (($default === 'none')? true : false), true);
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'solid', T_("Solid"), (($default === 'solid')? true : false), true);
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'gradient', T_("Gradient"), (($default === 'gradient')? true : false), true);
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'image', T_("Image"), (($default === 'image')? true : false), true);

				$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
			}
			$html .= '</form>';

			$html .= '<div data-response="opt_background_pack" data-response-where="solid" '.(($default === 'solid') ? null : 'data-response-hide').'>';
			{
				$html .= background_color::admin_html();
			}
			$html .= '</div>';


			$html .= '<div data-response="opt_background_pack" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
			{
				$html .= background_gradient_type::admin_html();

				$html .= "<label for='color-opt_background_gradient_from' class='block mT10-f'>". T_("Gradient colors"). "</label>";
				$html .= background_gradient_from::admin_html();
				// $html .= background_gradient_via::admin_html();
				$html .= background_gradient_to::admin_html();
				$html .= background_color_random::admin_html_gradient();
			}
			$html .= '</div>';

			$html .= '<div data-response="opt_background_pack" data-response-where="image" '.(($default === 'image') ? null : 'data-response-hide').'>';
			{
				$html .= background_image::admin_html();
				$html .= background_position::admin_html();

				$html .= background_attachment::admin_html();

				$html .= background_size::admin_html();

				if(background_size::get_value() !== 'cover')
				{
					$html .= background_repeat::admin_html();
				}
			}
			$html .= '</div>';

			$html .= '<div data-response="opt_background_pack" data-response-where="video" '.(($default === 'video') ? null : 'data-response-hide').'>';
			{
				$html .= \content_site\options\video::admin_html();
			}
			$html .= '</div>';

		}

		$html .= '</div>';

		$html .= \content_site\options\type::admin_html();


		return $html;
	}

}
?>