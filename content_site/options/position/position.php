<?php
namespace content_site\options\position;


class position
{
	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'up',   'title' => T_("up") ,     ];
		$enum[] = ['key' => 'down', 'title' => T_("down") ,   ];
		$enum[] = ['key' => 'left',   	'title' => T_("left") ,    ];
		$enum[] = ['key' => 'right',   	'title' => T_("right") , 	    ];


		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Position')]);
	}


	public static function default()
	{
		return 'left';
	}

	public static function db_key()
	{
		return 'position';
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('position');

		if(!$default)
		{
			$default = static::default();
		}

		$title = T_("Border Radius");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_'. \content_site\utility::className(get_called_class());

			$radio_html = '';

			foreach (static::enum() as $key => $value)
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

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected, true);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>