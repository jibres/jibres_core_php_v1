<?php
namespace content_site\options\slider;


class slider_effect
{


	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'slide',     'title' => T_("Slide")];
		$enum[] = ['key' => 'fade',      'title' => T_("Fade")];
		$enum[] = ['key' => 'coverflow', 'title' => T_("Coverflow")];
		$enum[] = ['key' => 'flip',      'title' => T_("Flip")];
		$enum[] = ['key' => 'cube',      'title' => T_("Cube")];
		// $enum[] = ['key' => 'cards',     'title' => T_("Cards")];
		// $enum[] = ['key' => 'creative',  'title' => T_("Creative")];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);
		return $data;
	}




	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('slider_effect');


		$title = T_('Effect');


		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_slider_effect';

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