<?php
namespace content_site\options;


class container
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => T_("None"), 		'class' => '' ];
		$enum[] = ['key' => 'sm', 	'title' => T_("Small"), 	'class' => '' ];
		$enum[] = ['key' => 'md', 	'title' => T_("Medium"), 	'class' => '' ];
		$enum[] = ['key' => 'lg', 	'title' => T_("Large"), 	'class' => '' ];
		$enum[] = ['key' => 'xl', 	'title' => T_("X Large"), 	'class' => '' ];
		$enum[] = ['key' => 'xxl', 	'title' => T_("XX Large"), 	'class' => '' ];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Avand')]);
		return $data;
	}


	public static function default()
	{
		return 'lg';
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['container']))
		{
			$default = $_section_detail['preview']['container'];
		}
		else
		{
			$default = self::default();
		}

		$title = T_("Container");

		$html = '';

		$html .= '<form method="post" data-patch>';
		{
	   		$html .= '<input type="hidden" name="option" value="container">';
			$html .= "<label for='container'>$title</label>";
			$html .= '<input type="text" name="container-new" data-rangeSlider data-skin="round" data-force-edges data-from="3" data-values="'. implode(',', array_column(self::enum(), 'key')). '">';
		}

		$html .= '</form>';

		return $html;
	}

}
?>