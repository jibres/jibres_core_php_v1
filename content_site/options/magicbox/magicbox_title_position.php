<?php
namespace content_site\options\magicbox;


class magicbox_title_position
{


	private static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'hide', 'title' => T_("Hide")];
		$enum[] = ['key' => 'inside', 'title' => T_("Inside")];

		if(self::allow_outsite())
		{
			$enum[] = ['key' => 'outside', 'title' => T_("Outside")];
		}


		return $enum;
	}

	public static function allow_outsite()
	{
		return true;
	}


	public static function validator($_data)
	{
		$data[self::db_key()] = \dash\validate::enum(a($_data, self::db_key()), true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Position title')]);
		return $data;
	}



	public static function default()
	{
		return 'inside';
	}

	public static function db_key()
	{
		return 'magicbox_title_position';
	}



	public static function admin_html()
	{

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= self::only_el();
		}
		$html .= \content_site\options\generate::_form();

		return $html;
	}


	public static function only_el()
	{

		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_('Title position');
		$html = '';
		$html .= "<label>$title</label>";

		$name       = self::db_key();

		$radio_html = '';

		foreach (self::enum() as $key => $value)
		{
			$myValue = $value['key'];
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, $myValue, $value['title'], (($default === $myValue)? true : false), true);
		}

		$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

		return $html;
	}

}
?>