<?php
namespace content_site\options\background;


class background_repeat
{

	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'repeat', 'title' => T_('Yes')];
		$enum[] = ['key' => 'repeat x', 'title' => 'X'];
		$enum[] = ['key' => 'repeat y', 'title' => 'Y'];
		$enum[] = ['key' => 'no repeat', 'title' => T_('No')];

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



	public static function admin_html()
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
			$name       = 'opt_background_repeat';

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