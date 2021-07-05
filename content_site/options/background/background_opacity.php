<?php
namespace content_site\options\background;


class background_opacity
{

	private static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => '0'];
		$enum[] = ['key' => '5'];
		$enum[] = ['key' => '10'];
		$enum[] = ['key' => '20'];
		$enum[] = ['key' => '25'];
		$enum[] = ['key' => '30'];
		$enum[] = ['key' => '40'];
		$enum[] = ['key' => '50'];
		$enum[] = ['key' => '60'];
		$enum[] = ['key' => '70'];
		$enum[] = ['key' => '75'];
		$enum[] = ['key' => '80'];
		$enum[] = ['key' => '90'];
		$enum[] = ['key' => '95'];
		$enum[] = ['key' => '100'];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Opacity')]);
		return $data;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_opacity');

		if(!$default)
		{
			$default = '100';
		}


		$title = T_("Background opacity");

		$this_range = array_column(self::enum(), 'key');

		$html = '';

		$html .= '<form method="post" data-patch>';
		{
			$html .= "<label for='opt_background_opacity'>$title</label>";
			$html .= '<input type="text" name="opt_background_opacity" data-rangeSlider data-skin="round" data-force-edges data-from="'.array_search($default, $this_range).'" value="'.array_search($default, $this_range).'" data-values="'. implode(',', $this_range). '">';
		}

		$html .= '</form>';

		return $html;
	}

}
?>