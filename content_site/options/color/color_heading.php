<?php
namespace content_site\options\color;


class color_heading extends \content_site\options\background\background_color
{
	public static function default()
	{
		return '#333333';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('color_heading');

		$heading = \content_site\section\view::get_current_index_detail('heading');

		if($heading || $heading === '0')
		{
			if(!$default)
			{
				$default = self::default();
			}

			$title = T_("Heading Text Color");

			$html = self::color_html('opt_color_heading', $default, $title);

			return $html;
		}

		return null;
	}

}
?>