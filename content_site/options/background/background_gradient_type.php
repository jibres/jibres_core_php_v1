<?php
namespace content_site\options\background;


class background_gradient_type
{

	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'to top', 'title' => T_("To top")];
		$enum[] = ['key' => 'to top right', 'title' => T_("To top right")];
		$enum[] = ['key' => 'to right', 'title' => T_("To right")];
		$enum[] = ['key' => 'to bottom right', 'title' => T_("To bottom right")];
		$enum[] = ['key' => 'to bottom', 'title' => T_("To bottom")];
		$enum[] = ['key' => 'to bottom left', 'title' => T_("To bottom left")];
		$enum[] = ['key' => 'to left', 'title' => T_("To left")];
		$enum[] = ['key' => 'to top left', 'title' => T_("To top left")];
		// $enum[] = ['key' => 'redial', 'title' => T_("Redial")];

		return $enum;
	}

	public static function extends_option()
	{
		return background_pack::extends_option();
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Background Gradient Type')]);
		return $data;
	}


	public static function default()
	{
		return 'to top';
	}


	public static function name()
	{
		return 'background_gradient_type';
	}


	public static function title()
	{
		return T_("Gradient direction");
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(static::name());

		if(!$default)
		{
			$default = static::default();
		}




		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), static::enum(), $default, static::title());
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>