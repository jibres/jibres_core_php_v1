<?php
namespace content_site\options\background;


class background_repeat
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'repeat'];
		$enum[] = ['key' => 'no repeat'];
		$enum[] = ['key' => 'repeat x'];
		$enum[] = ['key' => 'repeat y'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Repeat')]);
		return $data;
	}


	public static function default()
	{
		return 'repeat';
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_repeat');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Background Repeat");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_repeat'>$title</label>";

	        $html .= "<label for='background_repeat'>$title</label>";

			$name       = 'opt_background_repeat';

			$radio_html = '';
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'repeat', T_('Yes'), (($default === 'repeat')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'repeat x', 'X', (($default === 'repeat x')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'repeat y', 'Y', (($default === 'repeat y')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'no repeat', T_('No'), (($default === 'no repeat')? true : false));

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);

		}
  		$html .= '</form>';

		return $html;
	}

}
?>