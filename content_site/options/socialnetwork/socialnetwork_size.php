<?php
namespace content_site\options\socialnetwork;


class socialnetwork_size
{

	public static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'sm', 	 'title' => "S",    'size' => '7' ];
		$enum[] = ['key' => 'md', 	 'title' => "M",    'size' => '9'];
		$enum[] = ['key' => 'lg', 	 'title' => "L",    'size' => '11'];


		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Size')]);
		return $data;
	}



	public static function default()
	{
		return 'md';
	}


	public static function size($_key)
	{
		$enum = static::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if($value['key'] === static::default())
				{
					return $value['size'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['size'];
				}
			}
		}
	}


	public static function db_key()
	{
		return 'size';
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		if(!$default)
		{
			$default = static::default();
		}


		$title = T_("Size");

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

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();



		return $html;
	}

}
?>