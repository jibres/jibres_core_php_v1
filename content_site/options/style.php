<?php
namespace content_site\options;


class style
{



	public static function admin_html($_section_detail)
	{
		$html = '';

		$url = \dash\url::that(). '/style'. \dash\request::full_get();

		$background       = \content_site\options\background\background_pack::get_full_backgroun_class($current_style);
		$background_class = a($background, 'class');
		$background_attr  = a($background, 'attr');

		$html .= "<a href='$url' class='btn mt-10 block $background_class' $background_attr>". T_("Personalization Desgin"). '</a>';


		return $html;
	}

}
?>