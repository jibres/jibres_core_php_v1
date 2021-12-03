<?php
namespace content_site\options\color;


class color extends \content_site\options\background\background_color
{


	public static function default()
	{
		return '#333333';
	}


	public static function db_key()
	{
		return 'color';
	}


	public static function title()
	{
		return T_("Color");
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		if(!$default)
		{
			$default = static::default();
		}

		$html = static::color_html('opt_'. static::db_key(), $default, static::title());

		return $html;
	}

}
?>