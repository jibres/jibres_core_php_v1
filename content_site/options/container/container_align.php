<?php
namespace content_site\options\container;


class container_align
{

	public static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'start', 'title' => T_("Top"), 'icon' => \dash\utility\icon::svg('AlignStart', 'pack'),  'class' => 'flex-wrap content-start' ];
		$enum[] = ['key' => 'center','title' => T_("Center"), 'icon' => \dash\utility\icon::svg('AlignCenter', 'pack'),  'class' => 'flex-wrap content-center'];
		$enum[] = ['key' => 'end', 	 'title' => T_("End"), 'icon' => \dash\utility\icon::svg('AlignEnd', 'pack'), 'class' => 'flex-wrap content-end'];


		return $enum;
	}



	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Align')]);


		return $data;

	}


	public static function default()
	{
		return 'start';
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
		return 'container_align';
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('container_align');

		if(!$default)
		{
			$default = static::default();
		}


		$title = T_("Align");

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

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();



		return $html;
	}

}
?>