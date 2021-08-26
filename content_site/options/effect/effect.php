<?php
namespace content_site\options\effect;


class effect
{

	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'none', 'title' => T_('None')];
		$enum[] = ['key' => 'zoom', 'title' => T_('Zoom')];
		$enum[] = ['key' => 'dark', 'title' => T_('Dark')];
		$enum[] = ['key' => 'light','title' => T_('Light')];


		return $enum;
	}

	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);
	}


	public static function default()
	{
		return 'm';
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('effect');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Effect");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= '<input type="hidden" name="notredirect" value="1">';

			$html .= "<label>$title</label>";

			$name       = 'opt_effect';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				if(isset($value['system']) && $value['system'])
				{
					continue;
				}

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