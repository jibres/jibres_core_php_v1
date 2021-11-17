<?php
namespace content_site\options\background;


trait background_gradient_to
{
	use background_color;

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
		$default = \content_site\section\view::get_current_index_detail(self::name());

		if(!$default)
		{
			$default = self::default();
		}

		$html = self::color_html('opt_'. self::name(), $default, self::title(), true, false);

		return $html;
	}

}
?>