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


			'height',
			'coverratio',

			// skip draw this option in html
			'background_color',

			'background_position',
			'background_repeat',
			'background_size',
			'background_attachment',

			'file',

			'background_gradient',
			'background_gradient_from',
			'background_gradient_via',
			'background_gradient_to',
			'background_gradient_type',
			'background_gradient_attachment',
			'background_color_random',

			'color_text',

			'font',

			'type',
		];
	}






	public static function enum()
	{
		return ['none', 'solid', 'gradient', 'image', 'video'];
	}


	public static function validator($_data)
	{
		if(a($_data, 'set_template'))
		{
			return self::validator_template($_data);
		}

		$data = \dash\validate::enum($_data, true, ['enum' => self::enum(), 'field_title' => T_('Background Pack')]);
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

		$func_get_args = func_get_args();

		$html = '';


		$current_style = a($_section_detail, 'preview');

		if(!is_array($current_style))
		{
			$current_style = [];
		}

		$html .= \content_site\options\height::admin_html();
		$html .= \content_site\options\coverratio::admin_html();

		$html .= "<div class='ShowCustomizeSetting'>";
		{
			$html .= \content_site\options\font::admin_html();
			$html .= \content_site\options\color\color_text::admin_html();

			$html .= '<form method="post" class="mb-5" data-patch>';
			{

				$html .= '<input type="hidden" name="notredirect" value="1">';
				$html .= "<label for='background_pack'>". T_("Background Type") ."</label>";

				$name       = 'opt_background_pack';

				$radio_html = '';
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'none', T_('Transparent'), (($default === 'none')? true : false));
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'solid', T_("Solid"), (($default === 'solid')? true : false));
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'gradient', T_("Gradient"), (($default === 'gradient')? true : false));
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'image', T_("Image"), (($default === 'image')? true : false));

				$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
			}
			$html .= '</form>';

			$html .= '<div data-response="opt_background_pack" data-response-where="solid" '.(($default === 'solid') ? null : 'data-response-hide').'>';
			{
				$html .= background_color::admin_html();
				$html .= background_color_random::admin_html_solid();
			}
			$html .= '</div>';


			$html .= '<div data-response="opt_background_pack" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
			{
				$html .= "<label for='color-opt_background_gradient_from' class='block'>". T_("Gradient colors"). "</label>";
				$html .= background_gradient_from::admin_html();
				// $html .= background_gradient_via::admin_html();
				$html .= background_gradient_to::admin_html();
				$html .= background_color_random::admin_html_gradient();
				$html .= background_gradient_type::admin_html();
			}
			$html .= '</div>';

			$html .= '<div data-response="opt_background_pack" data-response-where="image" '.(($default === 'image') ? null : 'data-response-hide').'>';
			{
				$html .= \content_site\options\file::admin_html();
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




	public static function style_template()
	{
		return
		[
			[
				'title'                    => T_("ABC def"),
				'opt_background_pack'          => 'solid',
				'background_color'         => '#ffffff',
				'color_text'               => '#000000',
			],
				[
				'title'                    => T_("ABC def"),
				'opt_background_pack'          => 'solid',
				'background_color'         => '#000000',
				'color_text'               => '#ffffff',
			],
		];
	}


	public static function template_or_custom($_data, $_template)
	{
		if(
			a($_data, 'background_pack')          == a($_template, 'background_pack') &&
			a($_data, 'background_gradient_type') == a($_template, 'background_gradient_type') &&
			a($_data, 'background_gradient_from') == a($_template, 'background_gradient_from') &&
			a($_data, 'background_gradient_via')  == a($_template, 'background_gradient_via') &&
			a($_data, 'background_gradient_to')   == a($_template, 'background_gradient_to') &&
			a($_data, 'background_color')         == a($_template, 'background_color') &&
			a($_data, 'color_text')               == a($_template, 'color_text')
		  )
		{
			return true;
		}

		return false;
	}


	public static function validator_template($_data)
	{
		$condition =
		[
			'background_pack'          => ['enum' => \content_site\options\background\background_pack::enum()],
			'background_gradient_type' => ['enum' => array_column(\content_site\options\background\background_gradient_type::enum(), 'key')],
			'background_gradient_from' => 'color',
			'background_gradient_via'  => 'color',
			'background_gradient_to'   => 'color',
			'background_color'         => 'color',
			'color_text'               => 'color',
			'color_text_hover'         => 'color',
			'color_text_focus'         => 'color',
		];

		$args =
		[
			'background_pack'          => a($_data, 'background_pack'),
			'background_gradient_type' => a($_data, 'background_gradient_type'),
			'background_gradient_from' => a($_data, 'background_gradient_from'),
			'background_gradient_via'  => a($_data, 'background_gradient_via'),
			'background_gradient_to'   => a($_data, 'background_gradient_to'),
			'background_color'         => a($_data, 'background_color'),
			'color_text'               => a($_data, 'color_text'),
			'color_text_hover'         => a($_data, 'color_text_hover'),
			'color_text_focus'         => a($_data, 'color_text_focus'),
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[
				'background_gradient_type' => T_("Background Gradient type"),
				'background_gradient_from' => T_("Background Gradient from"),
				'background_gradient_via'  => T_("Background Gradient via"),
				'background_gradient_to'   => T_("Background Gradient to"),
			],
		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		return $data;
	}


}
?>