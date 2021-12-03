<?php
namespace content_site\options\color;


class color_text extends \content_site\options\background\background_color
{
	public static function default()
	{
		return '#333333';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('color_text');

		if(!$default)
		{
			$default = static::default();
		}

		$title = T_("Text Color");

		$html = static::color_html('opt_color_text', $default, $title);

		return $html;
	}

}
?>