<?php
namespace content_site\options\color;


class color_text_hover extends \content_site\options\background\background_color
{
	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('color_text_hover');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Text Color Hover");

		$html = self::color_html('opt_color_text_hover', $default, $title);

		return $html;
	}

}
?>