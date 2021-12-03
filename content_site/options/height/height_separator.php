<?php
namespace content_site\options\height;


class height_separator
{

	public static function this_range()
	{
		return range(1, 10);
	}


	public static function validator($_data)
	{
		$data = \dash\validate::int($_data);

		if(!in_array($data, static::this_range()))
		{
			\dash\notif::error(T_("This range is not defined!"));
			return false;
		}

		return $data;
	}


	public static function db_key()
	{
		return 'height_separator';
	}

	public static function default()
	{
		return 5;
	}


	public static function title()
	{
		return T_("Thickness");
	}


	public static function admin_html()
	{
		$option_name = \content_site\utility::className(get_called_class());

		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		if(!$default)
		{
			$default = static::default();
		}

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::rangeslider('opt_'. $option_name, static::this_range(), $default, static::title());
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>