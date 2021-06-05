<?php
namespace lib\sitebuilder\options;


class radius
{
	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => '0', 		'title' => "0", 			];
		$enum[] = ['key' => '1x', 		'title' => "1x", 			];
		$enum[] = ['key' => '2x', 		'title' => "2x", 			];
		$enum[] = ['key' => '3x', 		'title' => "3x", 			];
		$enum[] = ['key' => '4x', 		'title' => "4x", 			];
		$enum[] = ['key' => 'circle', 	'title' => T_("Circle"), 	];

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Radius')]);
		return $data;
	}


	public static function default()
	{
		return '1x';
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['radius']))
		{
			$default = $_section_detail['preview']['radius'];
		}
		else
		{
			$default = self::default();
		}

		$title = T_("Set item radius");

		$html = '';
		$html .= '<form method="post" data-patch>';
    	$html .= '<input type="hidden" name="option" value="radius">';
		$html .= "<label for='radius'>$title</label>";
        $html .= '<select name="radius" class="select22" id="radius">';

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