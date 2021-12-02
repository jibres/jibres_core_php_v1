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

		if(self::full_effect())
		{
			$enum[] = ['key' => 'cards',     'title' => T_("Cards")];
		}
		// $enum[] = ['key' => 'creative',  'title' => T_("Creative")];

		return $enum;
	}


	public static function full_effect()
	{
		return false;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);

		\content_site\utility::need_redirect(true);

		return $data;
	}


	public static function db_key()
	{
		return 'slider_effect';
	}



	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('slider_effect');


		$title = T_('Effect');


		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_'. \content_site\utility::className(get_called_class());

			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				$myValue = $value['key'];
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $myValue, $value['title'], (($default === $myValue)? true : false), true);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>