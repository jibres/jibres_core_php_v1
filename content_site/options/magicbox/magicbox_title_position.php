<?php
namespace content_site\options\magicbox;


trait magicbox_title_position
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
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Position title')]);
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

		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_('Title position');


		$html = '';
		$html .= '<form method="post" data-patch>';
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
		$html .= '</form>';

		return $html;
	}

}
?>