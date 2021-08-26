<?php
namespace content_site\options;


// class height
// {
// 	public static function enum()
// 	{
// 		$enum   = [];
// 		$enum[] = ['key' => 'auto', 'title' => T_("Auto") , 'class' => 'height-auto', 'default' => true];
// 		// max-height:80vh; height:50vw; padding: 50px 0;
// 		$enum[] = ['key' => 'xs',   'title' => T_("Short") , 'class' => 'height-xs', ];
// 		// max-height:...; height:90px; md:height:125px; padding: 50px 0;
// 		$enum[] = ['key' => 'sm',   'title' => T_("Fairly Short") , 'class' => 'height-sm', ];
// 		// max-height:..; height:225px; md:height:300px; padding: 50px 0;
// 		$enum[] = ['key' => 'md',   'title' => T_("Medium") , 'class' => 'height-md', ];
// 		// max-height:...; height:350px; md:height:475px; padding: 50px 0;
// 		$enum[] = ['key' => 'lg',   'title' => T_("Tall") , 'class' => 'height-lg', ];
// 		// max-height:...; height:470px; md:height:650px; padding: 50px 0;
// 		$enum[] = ['key' => 'xl',   'title' => T_("Full Screen") , 'class' => 'height-xl', ];
// 		// max-height:... height:580px; md:height:775px; padding: 50px 0;
// 		// min-height:100vh; min-height:100%; md:height:775px; padding: 50px 0;

// 		return $enum;
// 	}

// 	public static function validator($_data)
// 	{
// 		$quick = a($_data, 'height_quick');
// 		$quick = \dash\validate::enum($quick, true, ['enum' => ['xs', 'auto', 'xl', 'more'], 'field_title' => T_('Height')]);

// 		$data = a($_data, 'height');
// 		$data = \dash\validate::enum($data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);

// 		if($quick === 'more' && !$data)
// 		{
// 			$data = self::default();
// 		}

// 		if($quick !== 'more')
// 		{
// 			return $quick;
// 		}

// 		return $data;
// 	}


// 	public static function default()
// 	{
// 		return 'auto';
// 	}


// 	public static function class_name($_key)
// 	{
// 		$enum = self::enum();

// 		foreach ($enum as $key => $value)
// 		{
// 			if(!$_key)
// 			{
// 				if($value['key'] === self::default())
// 				{
// 					return $value['class'];
// 				}
// 			}
// 			else
// 			{
// 				if($value['key'] === $_key)
// 				{
// 					return $value['class'];
// 				}
// 			}
// 		}
// 	}


// 	public static function admin_html($_default)
// 	{
// 		$default = \content_site\section\view::get_current_index_detail('height');

// 		if(!$default)
// 		{
// 			$default = self::default();
// 		}

// 		$title = T_("Section Height");

// 		$html = '';
// 		$html .= '<form method="post" data-patch>';
// 		{
// 			$html .= '<input type="hidden" name="notredirect" value="1">';
// 			$html .= '<input type="hidden" name="multioption" value="multi">';
// 			$html .= "<label>$title</label>";

// 			$name       = 'opt_height';
// 			$name_quick = $name. '_quick';

// 			$radio_html = '';
// 			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'xs', 'S', (($default === 'xs')? true : false));
// 			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'auto', 'M', (($default === 'auto')? true : false));
// 			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'xl', 'L', (($default === 'xl')? true : false));
// 			$radio_html .= \content_site\options\generate_radio_line::itemText($name_quick, 'more' , '...', (!in_array($default, ['xs', 'auto', 'xl']) ? true : false));

// 			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);

// 			$data_response_hide = null;

// 			if(in_array($default, ['xs', 'auto', 'xl']))
// 			{
// 				$data_response_hide = 'data-response-hide';
// 			}

// 			$this_range = array_column(self::enum(), 'key');

// 			$html .= "<div data-response='$name_quick' data-response-where='more' $data_response_hide>";
// 			$html .= '<input type="text" name="'.$name. '" data-rangeSlider data-skin="round" data-force-edges data-from="'.array_search($default, $this_range).'" value="'.$default.'" data-values="'. implode(',', $this_range). '">';
// 			$html .= '</div>';
// 		}
// 		$html .= '</form>';


// 		return $html;

// 	}
// }
?>