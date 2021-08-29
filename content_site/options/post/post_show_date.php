<?php
namespace content_site\options\post;


class post_show_date
{


	private static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'no', 'title' => T_("No")];
		$enum[] = ['key' => 'date', 'title' => T_("Date")];
		$enum[] = ['key' => 'full', 'title' => T_("DateTime")];
		$enum[] = ['key' => 'relative', 'title' => T_("Relative")];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Show date')]);
		return $data;
	}



	public static function default()
	{
		return 'no';
	}



	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('post_show_date');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_('Display publish date');


		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_post_show_date';

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