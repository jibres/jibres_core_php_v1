<?php
namespace content_site\options;


class style
{

	public static function style_template()
	{
		return
		[
			['title' => T_("White"), 'background_pack' => 'solid', 'background_color' => 'red-500', 'background_opacity' => '20'],
			['title' => T_("White gold"), 'background_pack' => 'solid', 'background_color' => 'gray-600', 'background_opacity' => '20'],
		];
	}


	public static function template_or_custom($_section_detail)
	{
		$background_gradient_type = a($_section_detail, 'preview', 'background', 'background_gradient_type');
		$background_gradient_from = a($_section_detail, 'preview', 'background', 'background_gradient_from');
		$background_gradient_via  = a($_section_detail, 'preview', 'background', 'background_gradient_via');
		$background_gradient_to   = a($_section_detail, 'preview', 'background', 'background_gradient_to');

		foreach(self::sample() as $gradient)
		{
			if(
				a($gradient, 'background_gradient_type') === $background_gradient_type &&
				a($gradient, 'background_gradient_from') === $background_gradient_from &&
				a($gradient, 'background_gradient_to') === $background_gradient_to &&
				a($gradient, 'background_gradient_via') === $background_gradient_via
			  )
			{
				return 'template';
			}
		}

		return 'custom';
	}


	public static function validator($_data)
	{
		$condition =
		[
			'background_gradient_type' => ['enum' => array_column(background_gradient_type::enum(), 'key')],
			'background_gradient_from' => ['enum' => array_column(background_gradient_from::enum(), 'color')],
			'background_gradient_via'  => ['enum' => array_column(background_gradient_via::enum(), 'color')],
			'background_gradient_to'   => ['enum' => array_column(background_gradient_to::enum(), 'color')],
		];

		$args =
		[
			'background_gradient_type' => a($_data, 'background_gradient_type'),
			'background_gradient_from' => a($_data, 'background_gradient_from'),
			'background_gradient_via'  => a($_data, 'background_gradient_via'),
			'background_gradient_to'   => a($_data, 'background_gradient_to'),
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

		var_dump($args);exit;
		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		return $data;
	}



	public static function admin_html()
	{
		$html = '';

		foreach (self::style_template() as $key => $value)
		{
			$background = background\background_pack::get_full_backgroun_class($value);
			$class      = a($background, 'class');
			$attr       = a($background, 'attr');

			$json    = json_encode(array_merge($value, ['multioption' => 'multi', 'opt_style' => true]));

			$html .= "<button data-ajaxify data-data='$json' class='btn mt-5 block $class' $attr>". a($value, 'title'). '</button>';

		}

		// $html .= '<nav class="items mT20">';
		// {
	 //  		$html .= '<ul>';
	 //  		{
	 //    		$html .= '<li>';
	 //    		{
	 //    			$link = \dash\url::that(). '/style'. \dash\request::full_get();

		//       		$html .= "<a class='item f' href='$link'>";
		//       		{
		//         		$html .= '<img src="'. \dash\utility\icon::url('Nature', 'major'). '">';
		//         		$html .= '<div class="key">'. T_("Style"). '</div>';
		//         		$html .= '<div class="go"></div>';
		//       		}
		//       		$html .= '</a>';
	 //    		}
	 //    		$html .= '</li>';
	 //  		}
	 //  		$html .= '</ul>';
		// }
		// $html .= '</nav>';

		return $html;
	}

}
?>