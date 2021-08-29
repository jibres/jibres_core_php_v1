<?php
namespace content_site\options\slider;


trait slider_size
{


	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'sm', 'title' => 'S' ];
		$enum[] = ['key' => 'md', 'title' => 'M' ];
		$enum[] = ['key' => 'lg', 'title' => 'L' ];
		$enum[] = ['key' => 'xl', 'title' => 'XL'];

		return $enum;
	}



	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('size')]);
		return $data;
	}


	public static function db_key()
	{
		return 'slider_size';
	}



	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('slider_size');


		$title = T_('Slide size');


		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_'. \content_site\utility::className(__CLASS__);

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				$myValue = $value['key'];
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $myValue, $value['title'], (($default === $myValue)? true : false), true);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>