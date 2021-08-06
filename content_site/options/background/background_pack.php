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


		// $selected = false;

		// $html .= "<span class='mb-5 block'>". T_("Style"). "</span>";

		// $selected_class = " border-2 border-gray-900";
		// foreach (self::style_template() as $key => $value)
		// {

		// 	$class = null;

		// 	$value['background_pack'] = a($value, 'opt_background_pack');

		// 	$background_style = \content_site\assemble\background::style($value);
		// 	$text_style = \content_site\assemble\text_color::style($value);

		// 	if(self::template_or_custom($current_style, $value))
		// 	{
		// 		// selected
		// 		$selected = true;
		// 		$class .= $selected_class;
		// 	}

		// 	$json    = json_encode(array_merge($value, ['multioption' => 'multi', 'set_template' => true]));

		// 	$html .= "<div data-ajaxify data-data='$json' class='flex rounded ring-1 ring-gray-200 hover:ring-blue-200 transition p-2.5 mb-2 $class' style='$background_style $text_style'>";
		// 	{
		// 		$html .= '<div class="w-16">Aa</div>';
		// 		$html .= '<div class="flex-grow">'. a($value, 'title'). '</div>';
		// 		$html .= '<div class="">';
		// 		$html .= '</div>';
		// 	}

		// 	$html .= '</div>';
		// }

		// $kerkere_class = null;
		// // if selected one template hide the customize setting
		// if($selected)
		// {
		// 	$customize_kerkere = "data-kerkere-content='hide'";
		// }
		// else
		// {
			$customize_kerkere = '';
		// 	$kerkere_class = $selected_class;
		// }


		// $html .= "<div data-kerkere='.ShowCustomizeSetting' class='flex rounded ring-1 ring-gray-200 hover:ring-blue-200 transition p-2.5 mb-2 $kerkere_class'>";
		// {
		// 	$html .= '<div class="w-16">Aa</div>';
		// 	$html .= '<div class="flex-grow">'. T_("Customize"). '</div>';
		// 	$html .= '<div class="">';
		// 	$html .= '</div>';
		// }
		// $html .= '</div>';

		$html .= \content_site\options\height::admin_html(...$func_get_args);
		$html .= \content_site\options\coverratio::admin_html(...$func_get_args);

		$html .= "<div class='ShowCustomizeSetting' $customize_kerkere>";
		{
			$html .= \content_site\options\font::admin_html(...$func_get_args);
			$html .= \content_site\options\color\color_text::admin_html(...$func_get_args);

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


				// $html .= "<span class='mt-5 block'>". T_("Background Type"). "</span>";

				// $html .= '<div class="row">';
				// {
				// 	$html .= '<div class="c-xs-12 c-sm-12 c-md-12">';
				// 	{
				// 		$html .= '<div class="radio1">';
				// 		{
				// 			$html .= '<input type="radio" name="opt_background_pack" value="none" id="background_pack_none" '.(($default === 'none') ? "checked" : null ).'>';
				// 			$html .= '<label for="background_pack_none">'. T_("None"). '</label>';
				// 		}
				// 		$html .= '</div>';
				// 	}
				// 	$html .= '</div>';

				// 	$html .= '<div class="c-xs-12 c-sm-12 c-md-12">';
				// 	{
				// 		$html .= '<div class="radio1">';
				// 		{
				// 			$html .= '<input type="radio" name="opt_background_pack" value="solid" id="background_pack_solid" '.(($default === 'solid') ? "checked" : null ).'>';
				// 			$html .= '<label for="background_pack_solid">'. T_("Solid"). '</label>';
				// 		}
				// 		$html .= '</div>';
				// 	}
				// 	$html .= '</div>';

				// 	$html .= '<div class="c-xs-12 c-sm-12 c-md-12">';
				// 	{
				// 		$html .= '<div class="radio1">';
				// 		{
				// 			$html .= '<input type="radio" name="opt_background_pack" value="gradient" id="background_pack_gradient" '.(($default === 'gradient') ? "checked" : null ).'>';
				// 			$html .= '<label for="background_pack_gradient">'. T_("Gradient"). '</label>';
				// 		}
				// 		$html .= '</div>';
				// 	}
				// 	$html .= '</div>';

				// 	$html .= '<div class="c-xs-12 c-sm-12 c-md-12">';
				// 	{
				// 		$html .= '<div class="radio1">';
				// 		{
				// 			$html .= '<input type="radio" name="opt_background_pack" value="image" id="background_pack_image" '.(($default === 'image') ? "checked" : null ).'>';
				// 			$html .= '<label for="background_pack_image">'. T_("Image"). '</label>';
				// 		}
				// 		$html .= '</div>';
				// 	}
				// 	$html .= '</div>';

					// $html .= '<div class="c-xs-12 c-sm-12 c-md-12">';
					// {
					// 	$html .= '<div class="radio1">';
					// 	{
					// 		$html .= '<input type="radio" name="opt_background_pack" value="video" id="background_pack_video" '.(($default === 'video') ? "checked" : null ).'>';
					// 		$html .= '<label for="background_pack_video">Video</label>';
					// 	}
					// 	$html .= '</div>';
					// }
					// $html .= '</div>';
				// }
				// $html .= '</div>';
			}
			$html .= '</form>';

			$html .= '<div data-response="opt_background_pack" data-response-where="solid" '.(($default === 'solid') ? null : 'data-response-hide').'>';
			{
				$html .= background_color::admin_html(...$func_get_args);
			}
			$html .= '</div>';


			$html .= '<div data-response="opt_background_pack" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
			{
				$html .= "<span class='mb-5 block'>". T_("Gradient colors"). "</span>";
				$html .= background_gradient_from::admin_html(...$func_get_args);
				// $html .= background_gradient_via::admin_html(...$func_get_args);
				$html .= background_gradient_to::admin_html(...$func_get_args);
				$html .= background_gradient_type::admin_html(...$func_get_args);
			}
			$html .= '</div>';

			$html .= '<div data-response="opt_background_pack" data-response-where="image" '.(($default === 'image') ? null : 'data-response-hide').'>';
			{
				$html .= \content_site\options\file::admin_html(...$func_get_args);
				$html .= background_position::admin_html(...$func_get_args);

				$html .= background_attachment::admin_html(...$func_get_args);

				$html .= background_size::admin_html(...$func_get_args);

				if(background_size::get_value(...$func_get_args) !== 'cover')
				{
					$html .= background_repeat::admin_html(...$func_get_args);
				}
			}
			$html .= '</div>';

			$html .= '<div data-response="opt_background_pack" data-response-where="video" '.(($default === 'video') ? null : 'data-response-hide').'>';
			{
				$html .= \content_site\options\video::admin_html(...$func_get_args);
			}
			$html .= '</div>';

		}

		$html .= '</div>';

		$html .= \content_site\options\type::admin_html(...$func_get_args);


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