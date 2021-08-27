<?php
namespace content_site\options\radius;


trait radius
{
	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none',   'title' => 'None' ,     'class' => 'rounded-none' ];
		$enum[] = ['key' => 'normal', 'title' => 'Normal' ,   'class' => 'rounded' ];
		$enum[] = ['key' => 'lg',   	'title' => 'Large' ,    'class' => 'rounded-lg' ];
		$enum[] = ['key' => '3xl',   	'title' => '3xl' , 	    'class' => 'rounded-3xl' ];

		if(self::enum_type() === 'full')
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
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);
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

			$name       = 'opt_'. \content_site\utility::className(__CLASS__);

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