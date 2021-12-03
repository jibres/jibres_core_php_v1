<?php
namespace content_site\options\background;


class background_repeat
{

	public static function enum()
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
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Background Repeat')]);
		return $data;
	}


	public static function extends_option()
	{
		return background_pack::extends_option();
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
			$default = static::default();
		}

		$title = T_("Background Repeat");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label for='background_repeat'>$title</label>";
			$name       = 'opt_background_repeat';

			$radio_html = '';

			foreach (static::enum() as $key => $value)
			{
				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}


			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>