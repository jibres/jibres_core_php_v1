<?php
namespace content_site\options\socialnetwork;


class socialnetwork_size
{

	private static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'sm', 	 'title' => "S",    'class' => 'text-sm' ];
		$enum[] = ['key' => 'md', 	 'title' => "M",    'class' => 'text-md'];
		$enum[] = ['key' => 'lg', 	 'title' => "L",    'class' => 'text-lg'];


		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Size')]);


		return $data;

	}


	public static function default()
	{
		return 'lg';
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


	public static function db_key()
	{
		return 'heading_size';
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Size");

		$this_range = array_column(self::enum(), 'key');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_'. \content_site\utility::className(__CLASS__);

			$radio_html = '';
			foreach (self::enum() as $key => $value)
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