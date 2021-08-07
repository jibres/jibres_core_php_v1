<?php
namespace content_site\options\background;


class background_attachment
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'fixed'];
		$enum[] = ['key' => 'local'];
		$enum[] = ['key' => 'scroll'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Attachment')]);
		return $data;
	}


	public static function default()
	{
		return 'fixed';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_attachment');

		if(!$default)
		{
			$default = self::default();
		}



		$title = T_('Background Attachment');

		$html = '';
		$html .= '<form method="post" data-patch>';
		{

			$html .= "<label for='background_attachment'>$title</label>";

			$name       = 'opt_background_attachment';

			$radio_html = '';
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'fixed', T_('Fixed'), (($default === 'fixed')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'local', T_('Local'), (($default === 'local')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'scroll', T_('Scroll'), (($default === 'scroll')? true : false));

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);

		}
  		$html .= '</form>';

		return $html;
	}

}
?>