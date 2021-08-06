<?php
namespace content_site\options\background;


class background_size
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto'];
		$enum[] = ['key' => 'cover'];
		$enum[] = ['key' => 'contain'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Size')]);
		return $data;
	}


	public static function default()
	{
		return 'cover';
	}


	public static function get_value($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_size');

		if(!$default)
		{
			$default = self::default();
		}

		return $default;
	}


	public static function admin_html($_section_detail)
	{

		$default = self::get_value($_section_detail);


		$title = T_("Background size");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_size'>$title</label>";

			$name       = 'opt_background_size';

			$radio_html = '';
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'auto', 'Auto', (($default === 'auto')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'cover', 'Cover', (($default === 'cover')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'contain', 'Contain', (($default === 'contain')? true : false));

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
  		$html .= '</form>';

		return $html;
	}

}
?>