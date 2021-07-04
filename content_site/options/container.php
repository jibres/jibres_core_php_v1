<?php
namespace content_site\options;


class container
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => T_("None"), 		'class'   => '' ];
		$enum[] = ['key' => 'sm', 	'title' => T_("Small"), 	'class'   => 'avand-sm' ];
		$enum[] = ['key' => 'md', 	'title' => T_("Medium"), 	'class'   => 'avand-md' ];
		$enum[] = ['key' => 'lg', 	'title' => T_("Large"), 	'class'   => 'avand-lg' ];
		$enum[] = ['key' => 'xl', 	'title' => T_("X Large"), 'class'   => 'avand-xl' ];
		$enum[] = ['key' => 'auto', 'title' => T_("Auto"), 	  'class'   => 'avand', 'default' => true ];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Container')]);
		return $data;
	}


	public static function default()
	{
		return 'auto';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if(isset($value['default']) && $value['default'])
				{
					return $value['class'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class'];
				}
			}
		}
	}


	public static function admin_html($_section_detail)
	{

		$default = \content_site\section\view::get_current_index_detail('container');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Container");

		$this_range = array_column(self::enum(), 'key');

		$html = '';

		$html .= '<form method="post" data-patch>';
		{
	   		$html .= '<input type="hidden" name="option" value="container">';
			$html .= "<label for='container'>$title</label>";
			$html .= '<input type="text" name="container" data-rangeSlider data-skin="round" data-force-edges data-from="'.array_search($default, $this_range).'" value="'.array_search($default, $this_range).'" data-values="'. implode(',', $this_range). '">';
		}

		$html .= '</form>';

		return $html;
	}

}
?>