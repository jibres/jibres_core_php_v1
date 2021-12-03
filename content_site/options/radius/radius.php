<?php
namespace content_site\options\radius;


class radius
{
	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none',   'title' => 'None' ,     'class' => 'rounded-none' ];
		$enum[] = ['key' => 'normal', 'title' => 'Normal' ,   'class' => 'rounded' ];
		$enum[] = ['key' => 'lg',   	'title' => 'Large' ,    'class' => 'rounded-lg' ];
		$enum[] = ['key' => '3xl',   	'title' => '3xl' , 	    'class' => 'rounded-3xl' ];

		if(static::enum_type() === 'full')
		{
			$enum[] = ['key' => 'full',   'title' => 'Full',      'class' => 'rounded-full' ];
		}

		return $enum;
	}

	public static function enum_type()
	{
		return 'full';
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Height')]);
	}


	public static function default()
	{
		return 'none';
	}

	public static function db_key()
	{
		return 'radius';
	}

	public static function class_name($_key)
	{
		$enum = static::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === static::default())
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