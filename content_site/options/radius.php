<?php
namespace content_site\options;


class radius
{
	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => '0x' ,   'class' => 'rounded-none' ];
		$enum[] = ['key' => 's',   	'title' => '1x' ,   'class' => 'rounded-sm' ];
		$enum[] = ['key' => 'm',   	'title' => '2x' ,   'class' => 'rounded-md' ];
		$enum[] = ['key' => 'l',   	'title' => '3x' , 	'class' => 'rounded-lg' ];
		$enum[] = ['key' => 'full', 'title' => 'Full',  'class' => 'rounded-full' ];

		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);
	}


	public static function default()
	{
		return 'm';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === self::default())
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


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('radius');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Border Radius");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= '<input type="hidden" name="notredirect" value="1">';

			$html .= "<label>$title</label>";

			$name       = 'opt_radius';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				if(isset($value['system']) && $value['system'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';


		return $html;

	}
}
?>