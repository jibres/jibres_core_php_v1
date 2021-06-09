<?php
namespace content_site\options;


class effect
{
	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'none', 		'title' => T_("None"), 			];
		$enum[] = ['key' => 'zoom', 		'title' => T_("Zoom"), 			];
		$enum[] = ['key' => 'darkShadow', 	'title' => T_("Dark Shadow"), 	];
		$enum[] = ['key' => 'whiteShadow', 	'title' => T_("White Shadow"), 	];
		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);
		return $data;
	}


	public static function default()
	{
		return 'none';
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['effect']))
		{
			$default = $_section_detail['preview']['effect'];
		}
		else
		{
			$default = self::default();
		}

		$title = T_("Set item effect");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="effect">';
			$html .= "<label for='effect'>$title</label>";
	        $html .= '<select name="effect" class="select22" id="effect">';

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
		}
  		$html .= '</form>';

		return $html;
	}

}
?>