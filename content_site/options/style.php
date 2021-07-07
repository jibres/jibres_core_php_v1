<?php
namespace content_site\options;


class style
{

	public static function style_template()
	{
		return
		[
			[
				'title'                    => T_("White"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'gradient-to-r',
				'background_gradient_from' => 'pink-500',
				'background_gradient_via'  => 'red-500',
				'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'    => '50',
				// 'background_color'      => 'indigo-400',
				'color_text'               => 'yellow-400',
				'color_text_hover'         => 'yellow-800',
				'color_text_focus'         => 'gray-400',
				'color_opacity'            => '5',
			],

			[
				'title'                    => T_("White gold"),
				'background_pack'          => 'gradient',
				'background_gradient_type' => 'gradient-to-r',
				'background_gradient_from' => 'pink-500',
				'background_gradient_via'  => 'blue-500',
				'background_gradient_to'   => 'yellow-500',
				// 'background_opacity'    => '50',
				// 'background_color'      => 'indigo-400',
				'color_text'               => 'yellow-400',
				'color_text_hover'         => 'yellow-800',
				'color_text_focus'         => 'gray-400',
				'color_opacity'            => '5',
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

		foreach (self::style_template() as $key => $value)
		{
			$background = background\background_pack::get_full_backgroun_class($value);
			$class      = a($background, 'class');
			$attr       = a($background, 'attr');

			$json    = json_encode(array_merge($value, ['multioption' => 'multi', 'opt_style' => true]));

			$html .= "<button data-ajaxify data-data='$json' class='btn mt-5 block $class' $attr>";

			if(self::template_or_custom($current_style, $value))
			{
				$html .= 'selected';
				$selected = true;
			}

			$html .= a($value, 'title'). '</button>';
		}

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