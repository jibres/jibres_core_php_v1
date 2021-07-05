<?php
namespace content_site\options\background;


class background_gradient_from extends background_color
{
	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('background_gradient_from');

		if(!$default)
		{
			$default = 'white';
		}

		$title = T_("Background Gradient from");

		$html = self::color_html('opt_background_gradient_from', $default, $title);

		return $html;
	}

}
?>