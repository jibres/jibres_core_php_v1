<?php
namespace content_site\options;


class avand
{
	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'avand', 		'title' => T_("Container"), 		];
		$enum[] = ['key' => 'avand-sm', 	'title' => T_("Small"), 			];
		$enum[] = ['key' => 'avand-md', 	'title' => T_("Medium"), 			];
		$enum[] = ['key' => 'avand-lg', 	'title' => T_("Large"), 			];
		$enum[] = ['key' => 'avand-xl', 	'title' => T_("X Large"), 			];
		$enum[] = ['key' => 'avand-xxl', 	'title' => T_("XX Large"), 			];
		$enum[] = ['key' => 'none', 		'title' => T_("Without container"), ];

		return $enum;
	}

	private static function this_range()
	{
		return ['None','Small','Medium','Large','X Large','XX Large'];
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Avand')]);
		return $data;
	}


	public static function default()
	{
		return 'Large';
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['avand']))
		{
			$default = $_section_detail['preview']['avand'];
		}
		else
		{
			$default = self::default();
		}

		$title = T_("Container");

		$html = '';
		$html .= '<form method="post" data-patch>';
    $html .= '<input type="hidden" name="option" value="avand">';
		$html .= "<label for='avand'>$title</label>";
		$html .= '<input type="text" name="avand" data-rangeSlider data-skin="round" data-force-edges data-from="3" data-values="'. implode(',', self::this_range()). '">';
    $html .= '<select name="avand2" class="select22" id="avand">';

    foreach (self::enum() as $key => $value)
    {
    	$selected = null;

    	if($value['key'] === $default)
    	{
    		$selected = ' selected';
    	}

    	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
    }

    $html .= '</select>';
		$html .= '</form>';

		return $html;
	}

}
?>