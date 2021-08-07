<?php
namespace content_site\options\background;


class background_size
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto', 'title' => T_('Auto')];
		$enum[] = ['key' => 'cover', 'title' => T_('Cover')];
		$enum[] = ['key' => 'contain', 'title' => T_('Contain')];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Background Size')]);
		\content_site\utility::need_redirect(true);
		return $data;
	}


	public static function default()
	{
		return 'cover';
	}


	public static function get_value()
	{
		$default = \content_site\section\view::get_current_index_detail('background_size');

		if(!$default)
		{
			$default = self::default();
		}

		return $default;
	}


	public static function admin_html()
	{

		$default = self::get_value();


		$title = T_("Background size");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='background_size'>$title</label>";

			$name       = 'opt_background_size';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $value['key'], $value['title'], $selected);
			}


			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
  		$html .= '</form>';

		return $html;
	}

}
?>