<?php
namespace lib\sitebuilder\options;


class padding
{
	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'zero', 	'title' => T_("Zero"), 		];
		$enum[] = ['key' => 'normal', 	'title' => T_("Normal"), 	];
		$enum[] = ['key' => 'high', 	'title' => T_("High"), 		];
		$enum[] = ['key' => 'extra', 	'title' => T_("Extra"), 	];

		return $enum;
	}

	public static function validator()
	{

	}


	public static function default()
	{
		return 'normal';
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['padding']))
		{
			$default = $_section_detail['preview']['padding'];
		}
		else
		{
			$default = self::default();
		}

		$title = T_("Set item padding");

		$html = '';
		$html .= '<form method="post" data-patch>';
    	$html .= '<input type="hidden" name="option" value="padding">';
		$html .= "<label for='padding'>$title</label>";
        $html .= '<select name="padding" class="select22" id="padding">';

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