<?php
namespace content_site\options\background;


class background_gradient_via extends background_color
{
	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_gradient_via');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Background Gradient via");

		$html = self::color_html('opt_background_gradient_via', $default, $title, true);

		return $html;
	}

}
?>