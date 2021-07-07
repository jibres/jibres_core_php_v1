<?php
namespace content_site\options\background;


class background_opacity
{

	public static function enum()
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
		$data = \dash\validate::enum(a($_data, 'background_opacity'), true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Opacity')]);
		return $data;
	}


	public static function default()
	{
		return '100';
	}



	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_opacity');

		if(is_null($default))
		{
			$default = self::default();
		}

		$title = T_("Background opacity");

		return self::opacity_html('opt_background_opacity', $default, $title);

	}


	/**
	 * Use in color opacity
	 *
	 * @param      <type>  $_name     The name
	 * @param      <type>  $_default  The default
	 * @param      <type>  $_title    The title
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function opacity_html($_name, $_default, $_title)
	{
		$this_range = array_column(self::enum(), 'key');

		$html = '';

		$html .= '<form method="post" data-patch>';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= "<input type='hidden' name='$_name' value='1'>";
			$html .= "<label for='$_name'>$_title</label>";
			$html .= '<input type="text" name="background_opacity" data-rangeSlider data-skin="round" data-force-edges data-from="'.array_search($_default, $this_range).'" value="'.array_search($_default, $this_range).'" data-values="'. implode(',', $this_range). '">';
		}

		$html .= '</form>';

		return $html;

	}

}
?>