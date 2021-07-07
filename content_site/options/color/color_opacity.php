<?php
namespace content_site\options\color;


class color_opacity extends \content_site\options\background\background_opacity
{

	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('color_opacity');

		if(is_null($default))
		{
			$default = self::default();
		}

		$title = T_("Text opacity");

		return self::opacity_html('opt_color_opacity', $default, $title);

	}

}
?>