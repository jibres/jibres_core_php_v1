<?php
namespace content_site\options;


class style
{



	public static function admin_html($_section_detail)
	{


		$current_style = a($_section_detail, 'preview' , 'style');

		if(!is_array($current_style))
		{
			$current_style = [];
		}

		$selected = false;

		$html = '';

		$url = \dash\url::that(). '/style'. \dash\request::full_get();

		// $background       = \content_site\options\background\background_pack::get_full_backgroun_class($current_style);
		// $background_class = a($background, 'class');
		// $background_attr  = a($background, 'attr');
		// $text_color = \content_site\options\background\background_color::color_text_class_name(a($_section_detail, 'preview'));
		// $html .= "<a href='$url' class='btn mt-10 block $background_class $text_color' $background_attr>". T_("Personalization Desgin"). '</a>';
		$html .= "<a href='$url' class='btn mt-10 block'>". T_("Personalization Desgin"). '</a>';



		return $html;
	}

}
?>