<?php
namespace content_site\options\background;


class background_pack
{
	private static $current_options = [];


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


	public static function extends_option()
	{
		return
		[
			'background_color',

			'background_position',
			'background_repeat',
			'background_size',
			'background_attachment',

			'background_image',

			'background_gradient',
			'background_gradient_type',

			'background_gradient_from',
			'background_gradient_via',
			'background_gradient_to',

			'background_gradient_attachment',
			'background_color_random',
		];

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



		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>". T_("Background Type") ."</label>";

			$name       = 'opt_background_pack';

			$radio_html = '';
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'none', T_('Transparent'), (($default === 'none')? true : false), true);
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'solid', T_("Solid"), (($default === 'solid')? true : false), true);
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'gradient', T_("Gradient"), (($default === 'gradient')? true : false), true);
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'image', T_("Image"), (($default === 'image')? true : false), true);

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();

		$html .= '<div data-response="opt_background_pack" data-response-where="solid" '.(($default === 'solid') ? null : 'data-response-hide').'>';
		{
			$html .= background_color::admin_html();
		}
		$html .= '</div>';


		$html .= '<div data-response="opt_background_pack" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
		{
			$html .= background_gradient_type::admin_html();

			$html .= "<label for='color-opt_background_gradient_from' class='block mT5-f'>". T_("Gradient colors"). "</label>";
			$html .= background_gradient_from::admin_html();
			// $html .= background_gradient_via::admin_html();
			$html .= background_gradient_to::admin_html();
			$html .= background_color_random::admin_html_gradient();
		}
		$html .= '</div>';

		$html .= '<div data-response="opt_background_pack" data-response-where="image" '.(($default === 'image') ? null : 'data-response-hide').'>';
		{
			$html .= background_image::admin_html();
			$html .= background_color::admin_html();

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
			$html .= \content_site\options\file\file_video::admin_html();
		}
		$html .= '</div>';


		return $html;
	}

}
?>