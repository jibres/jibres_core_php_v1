<?php
namespace content_site\options;


class coverratio
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 's', 	];
		$enum[] = ['key' => 'm', 	];
		$enum[] = ['key' => 'l', 	];
		$enum[] = ['key' => 'xl', 	];
		$enum[] = ['key' => 'free', ];
		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Cover ratio')]);
		return $data;
	}


	public static function default()
	{
		return 'm';
	}



	public static function admin_html($_section_detail)
	{

		$default = \content_site\section\view::get_current_index_detail('coverratio');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Cover image ratio");

		$this_range = array_column(self::enum(), 'key');



		$html = '';
		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_coverratio';

			$radio_html = '';

			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 's', 'S', (($default === 's')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'm', 'M', (($default === 'm')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'l', 'L', (($default === 'l')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'xl', 'XL', (($default === 'xl')? true : false));
			$radio_html .= \content_site\options\generate_radio_line::itemText($name, 'free', 'Free', (($default === 'free')? true : false));

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';



		return $html;
	}

}
?>