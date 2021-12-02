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
		$enum[] = ['key' => 'gradient','title' => T_('Gradient')];


		return $enum;
	}

	public static function extends_option()
	{
		return
		[
			'effect',
			'effect_gradient_type',
			'effect_gradient_to'
		];
	}


	public static function validator($_data)
	{
		if($_data === 'gradient')
		{
			\content_site\utility::need_redirect(true);
		}

		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);
	}


	public static function default()
	{
		return 'm';
	}



	public static function admin_html()
	{
		$html = '';

		$default = \content_site\section\view::get_current_index_detail('effect');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Effect");

		$name       = 'opt_effect';

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), self::enum(), $default, $title);
		}
		$html .= \content_site\options\generate::_form();

		// {
		// 	$html .= "<label>$title</label>";


		// 	$radio_html = '';

		// 	foreach (self::enum() as $key => $value)
		// 	{
		// 		if(isset($value['system']) && $value['system'])
		// 		{
		// 			continue;
		// 		}

		// 		$selected = false;

		// 		if($default === $value['key'])
		// 		{
		// 			$selected = true;
		// 		}

		// 		$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
		// 	}

		// 	$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

		// }

		$html .= '<div data-response="'.$name.'" data-response-where="gradient" '.(($default === 'gradient') ? null : 'data-response-hide').'>';
		{
			$html .= effect_gradient_type::admin_html();

			$html .= "<label for='color-opt_background_gradient_from' class='block mT5-f'>". T_("Gradient colors"). "</label>";

			$html .= effect_gradient_to::admin_html();
		}
		$html .= '</div>';


		return $html;

	}
}
?>