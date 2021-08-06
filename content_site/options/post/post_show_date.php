<?php
namespace content_site\options\post;


class post_show_date
{


	private static function enum()
	{
		$enum   = [];


		$enum[] = ['key' => 'no', 'title' => T_("No")];
		$enum[] = ['key' => 'date', 'title' => T_("Date")];
		$enum[] = ['key' => 'full', 'title' => T_("DateTime")];
		$enum[] = ['key' => 'relative', 'title' => T_("Relative")];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Show date')]);
		return $data;
	}



	public static function default()
	{
		return null;
	}



	public static function admin_html($_section_detail)
	{

		$default = \content_site\section\view::get_current_index_detail('post_show_date');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_('Display publish date');


		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_post_show_date';

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				$myValue = $value['key'];
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $myValue, $value['title'], (($default === $myValue)? true : false));
			}

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';

		return $html;
	}



	// public static function admin_html($_section_detail)
	// {
	// 	$default = \content_site\section\view::get_current_index_detail('post_show_date');

	// 	if(!$default)
	// 	{
	// 		$default = self::default();
	// 	}

	// 	$checked = $default ? ' checked' : null;

	// 	$html = '';
	// 	$html .= '<form method="post" data-patch autocomplete="off">';
	// 	{
	// 		$html .= '<input type="hidden" name="multioption" value="multi">';
	// 		$html .= '<input type="hidden" name="opt_post_show_date" value="1">';
	// 		$html .= '<div class="check1 py-0">';
	// 		{
	// 			$html .= '<input type="checkbox" name="show_date" id="post_show_date"'.$checked.'>';
	// 			$html .= '<label for="post_show_date">'. T_('Display post date'). '</label>';
	// 		}
	// 		$html .= '</div>';
	// 	}

 //  		$html .= '</form>';

	// 	return $html;
	// }

}
?>