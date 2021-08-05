<?php
namespace content_site\options;


class coverratio
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => '3:1', ];
		$enum[] = ['key' => '16:9', ];
		$enum[] = ['key' => '1:1', 	];
		$enum[] = ['key' => '3:4', 	];
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

			foreach (self::enum() as $key => $value)
			{
				$myValue = $value['key'];
				$radio_html .= \content_site\options\generate_radio_line::itemText($name, $myValue, $myValue, (($default === $myValue)? true : false));
			}

			$html .= \content_site\options\generate_radio_line::add_ul($name, $radio_html);
		}
		$html .= '</form>';

		return $html;
	}


	public static function get_class($_ratio)
	{
		$coverRatioClass = '';
		switch ($_ratio)
		{
			case '4:1':
				$coverRatioClass = ' aspect-w-4 aspect-h-1';
				break;

			case '3:1':
				$coverRatioClass = ' aspect-w-3 aspect-h-1';
				break;

			case '16:9':
				$coverRatioClass = ' aspect-w-16 aspect-h-9';
				break;

			case '4:3':
				$coverRatioClass = ' aspect-w-4 aspect-h-3';
				break;

			case '1:1':
				$coverRatioClass = ' aspect-w-1 aspect-h-1';
				break;

			// vertical
			case '3:4':
				$coverRatioClass = ' aspect-w-3 aspect-h-4';
				break;

			case '9:16':
				$coverRatioClass = ' aspect-w-9 aspect-h-16';
				break;

			case 'free':
			default:
				break;
		}
		return $coverRatioClass;
	}

}
?>