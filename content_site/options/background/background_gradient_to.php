<?php
namespace content_site\options\background;


class background_gradient_to extends background_color
{


	public static function name()
	{
		return 'background_gradient_to';
	}


	public static function title()
	{
		return T_("Background Gradient to");
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(static::name());

		if(!$default)
		{
			$default = static::default();
		}

		$html = static::color_html('opt_'. static::name(), $default, static::title(), true, false);

		return $html;
	}

}
?>