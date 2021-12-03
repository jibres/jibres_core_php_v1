<?php
namespace content_site\options\justify;


class justify
{

	public static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'left', 'title' => T_("Left"), 'icon' => \dash\utility\icon::svg('JustifyLeft', 'pack'),  'class' => 'justify-start' ];
		$enum[] = ['key' => 'center','title' => T_("Center"), 'icon' => \dash\utility\icon::svg('JustifyCenter', 'pack'),  'class' => 'justify-center'];
		$enum[] = ['key' => 'right', 	 'title' => T_("Right"), 'icon' => \dash\utility\icon::svg('JustifyRight', 'pack'), 'class' => 'justify-end'];


		return $enum;
	}



	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => static::title()]);


		return $data;

	}


	public static function default()
	{
		return 'center';
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


	public static function db_key()
	{
		return 'justify';
	}


	public static function title()
	{
		return T_("Title");
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		if(!$default)
		{
			$default = static::default();
		}


		$title = static::title();

		$this_range = array_column(static::enum(), 'key');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_'. \content_site\utility::className(get_called_class());

			$radio_html = '';
			foreach (static::enum() as $key => $value)
			{
				if(isset($value['hide']) && $value['hide'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['icon'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html, true);
		}
		$html .= \content_site\options\generate::_form();



		return $html;
	}

}
?>