<?php
namespace content_site\options\background;


class background_color_header_line
{
	use background_color;

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_color_header_line');

		$title = T_("Header line color");

		$html = self::color_html('opt_background_color_header_line', $default, $title);

		return $html;
	}

}
?>