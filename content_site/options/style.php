<?php
namespace content_site\options;


class style
{

	public static function style_template()
	{
		return
		[
			[
				'title'                    => T_("White Minimal"),
				'background_pack'          => 'solid',
				// 'background_gradient_type' => 'gradient-to-r',
				// 'background_gradient_from' => 'pink-500',
				// 'background_gradient_via'  => 'red-500',
				// 'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'       => '50',
				'background_color'         => 'white',
				'color_text'               => 'gray-800',
				'color_text_hover'         => 'gray-900',
				'color_text_focus'         => 'gray-900',
				// 'color_opacity'            => '5',
			],
			[
				'title'                    => T_("White Gold"),
				'background_pack'          => 'solid',
				// 'background_gradient_type' => 'gradient-to-r',
				// 'background_gradient_from' => 'pink-500',
				// 'background_gradient_via'  => 'red-500',
				// 'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'       => '50',
				'background_color'         => 'white',
				'color_text'               => 'yellow-600',
				'color_text_hover'         => 'yellow-700',
				'color_text_focus'         => 'yellow-800',
				// 'color_opacity'            => '5',
			],
			[
				'title'                    => T_("Light Minimal"),
				'background_pack'          => 'solid',
				// 'background_gradient_type' => 'gradient-to-r',
				// 'background_gradient_from' => 'pink-500',
				// 'background_gradient_via'  => 'red-500',
				// 'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'       => '50',
				'background_color'         => 'purple-100',
				'color_text'               => 'gray-800',
				'color_text_hover'         => 'gray-900',
				'color_text_focus'         => 'gray-900',
				// 'color_opacity'            => '5',
			],
			[
				'title'                    => T_("Light Gold"),
				'background_pack'          => 'solid',
				// 'background_gradient_type' => 'gradient-to-r',
				// 'background_gradient_from' => 'pink-500',
				// 'background_gradient_via'  => 'red-500',
				// 'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'       => '50',
				'background_color'         => 'indigo-100',
				'color_text'               => 'yellow-600',
				'color_text_hover'         => 'yellow-700',
				'color_text_focus'         => 'yellow-800',
				// 'color_opacity'            => '5',
			],
		[
				'title'                    => T_("Light Minimal"),
				'background_pack'          => 'solid',
				// 'background_gradient_type' => 'gradient-to-r',
				// 'background_gradient_from' => 'pink-500',
				// 'background_gradient_via'  => 'red-500',
				// 'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'       => '50',
				'background_color'         => 'green-900',
				'color_text'               => 'white',
				'color_text_hover'         => 'gray-50',
				'color_text_focus'         => 'gray-50',
				// 'color_opacity'            => '5',
			],

			// [
			// 	'title'                    => T_("White gold"),
			// 	'background_pack'          => 'gradient',
			// 	'background_gradient_type' => 'gradient-to-r',
			// 	'background_gradient_from' => 'pink-500',
			// 	'background_gradient_via'  => 'blue-500',
			// 	'background_gradient_to'   => 'yellow-500',
			// 	// 'background_opacity'    => '50',
			// 	// 'background_color'      => 'indigo-400',
			// 	'color_text'               => 'yellow-400',
			// 	'color_text_hover'         => 'yellow-800',
			// 	'color_text_focus'         => 'gray-400',
			// 	'color_opacity'            => '5',
			// ],

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
			a($_data, 'background_opacity')       == a($_template, 'background_opacity') &&
			a($_data, 'background_color')         == a($_template, 'background_color') &&
			a($_data, 'color_text')               == a($_template, 'color_text') &&
			a($_data, 'color_text_hover')         == a($_template, 'color_text_hover') &&
			a($_data, 'color_text_focus')         == a($_template, 'color_text_focus') &&
			a($_data, 'color_opacity')            == a($_template, 'color_opacity')
		  )
		{
			return true;
		}

		return false;
	}


	public static function validator($_data)
	{
		$condition =
		[
			'background_pack'          => ['enum' => \content_site\options\background\background_pack::enum()],
			'background_gradient_type' => ['enum' => array_column(\content_site\options\background\background_gradient_type::enum(), 'key')],
			'background_gradient_from' => ['enum' => array_column(\content_site\options\background\background_gradient_from::enum(), 'color')],
			'background_gradient_via'  => ['enum' => array_column(\content_site\options\background\background_gradient_via::enum(), 'color')],
			'background_gradient_to'   => ['enum' => array_column(\content_site\options\background\background_gradient_to::enum(), 'color')],
			'background_opacity'       => ['enum' => array_column(\content_site\options\background\background_opacity::enum(), 'key')],
			'background_color'         => ['enum' => array_column(\content_site\options\background\background_color::enum(), 'color')],
			'color_text'               => ['enum' => array_column(\content_site\options\background\background_color::enum(), 'color')],
			'color_text_hover'         => ['enum' => array_column(\content_site\options\background\background_color::enum(), 'color')],
			'color_text_focus'         => ['enum' => array_column(\content_site\options\background\background_color::enum(), 'color')],
			'color_opacity'            => ['enum' => array_column(\content_site\options\background\background_opacity::enum(), 'key')],
		];

		$args =
		[
			'background_pack'          => a($_data, 'background_pack'),
			'background_gradient_type' => a($_data, 'background_gradient_type'),
			'background_gradient_from' => a($_data, 'background_gradient_from'),
			'background_gradient_via'  => a($_data, 'background_gradient_via'),
			'background_gradient_to'   => a($_data, 'background_gradient_to'),
			'background_opacity'       => a($_data, 'background_opacity'),
			'background_color'         => a($_data, 'background_color'),
			'color_text'               => a($_data, 'color_text'),
			'color_text_hover'         => a($_data, 'color_text_hover'),
			'color_text_focus'         => a($_data, 'color_text_focus'),
			'color_opacity'            => a($_data, 'color_opacity'),
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

		return ['style' => $data];
	}



	public static function admin_html($_section_detail)
	{
		$html = '';

		$current_style = a($_section_detail, 'preview' , 'style');

		if(!is_array($current_style))
		{
			$current_style = [];
		}

		$selected = false;

		$html .= "<div class='mt-5'>";
		$html .= "<label for='style' class='mt-5'>". T_("Style"). "</label>";

		foreach (self::style_template() as $key => $value)
		{

			$background = background\background_pack::get_full_backgroun_class($value);
			$class      = a($background, 'class');
			$attr       = a($background, 'attr');
			if(self::template_or_custom($current_style, $value))
			{
				// selected
				$selected = true;
				$class .= " border-2 border-gray-900";
			}

			$json    = json_encode(array_merge($value, ['multioption' => 'multi', 'opt_style' => true]));

			$html .= "<div data-ajaxify data-data='$json' class='flex rounded ring-1 ring-gray-200 hover:ring-blue-200 transition p-2.5 mb-2 $class' $attr>";
			{
				$html .= '<div class="w-16">Aa</div>';
				$html .= '<div class="flex-grow">'. a($value, 'title'). '</div>';
				$html .= '<div class="">';
				$html .= '</div>';
			}

			$html .= '</div>';
		}
		$html .= "</div>";

		$url = \dash\url::that(). '/style'. \dash\request::full_get();

		if($selected)
		{
			$html .= "<a href='$url' class='btn mt-5 block'>". T_("Personalization"). '</a>';
		}
		else
		{
			$background       = \content_site\options\background\background_pack::get_full_backgroun_class($current_style);
			$background_class = a($background, 'class');
			$background_attr  = a($background, 'attr');

			$html .= "<a href='$url' class='btn mt-5 block $background_class' $background_attr> selected". T_("Personalization"). '</a>';

		}

		return $html;
	}

}
?>