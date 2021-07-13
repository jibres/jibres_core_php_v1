<?php
namespace content_site\options;


class container
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'auto', 'title' => T_("Auto"), 	  'class'   => 'avand', 'default' => true ];
		$enum[] = ['key' => 'sm', 	'title' => T_("Small"), 	'class'   => 'avand-sm' ];
		$enum[] = ['key' => 'md', 	'title' => T_("Medium"), 	'class'   => 'avand-md' ];
		$enum[] = ['key' => 'lg', 	'title' => T_("Large"), 	'class'   => 'avand-lg' ];
		$enum[] = ['key' => 'xl', 	'title' => T_("X Large"), 'class'   => 'avand-xl' ];
		$enum[] = ['key' => 'none', 'title' => T_("None"), 		'class'   => '' ];

		return $enum;
	}


	public static function validator($_data)
	{
		$quick = a($_data, 'container_quick');
		$quick = \dash\validate::enum($quick, true, ['enum' => ['sm', 'auto', 'xl', 'more'], 'field_title' => T_('Height')]);

		$data = a($_data, 'container');
		$data = \dash\validate::enum($data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);

		if($quick === 'more' && !$data)
		{
			$data = self::default();
		}

		if($quick !== 'more')
		{
			return $quick;
		}

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


		$title = T_("Content Width");

		$this_range = array_column(self::enum(), 'key');



		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= "<label>$title</label>";

			$name       = 'opt_container';
			$name_quick = $name. '_quick';

			$radio_html = '';
			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'sm', 'S', (($default === 'sm')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'auto', 'M', (($default === 'auto')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'xl', 'L', (($default === 'xl')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'more' , '...', (!in_array($default, ['sm', 'auto', 'xl']) ? true : false));

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);

			$data_response_hide = null;

			if(in_array($default, ['sm', 'auto', 'xl']))
			{
				$data_response_hide = 'data-response-hide';
			}

			$this_range = array_column(self::enum(), 'key');

			$html .= "<div data-response='$name_quick' data-response-where='more' $data_response_hide>";
			$html .= '<input type="text" name="'.$name. '" data-rangeSlider data-skin="round" data-force-edges data-from="'.array_search($default, $this_range).'" value="'.$default .'" data-values="'. implode(',', $this_range). '">';
			$html .= '</div>';
		}
		$html .= '</form>';



		return $html;
	}

}
?>