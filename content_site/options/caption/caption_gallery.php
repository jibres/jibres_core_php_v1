<?php
namespace content_site\options\caption;


class caption_gallery
{

	public static function specialsave($_data)
	{
		$data = \dash\validate::string_100(a($_data, 'caption_gallery'));

		return \content_site\body\gallery\option::update_one_gallery_item(['title' => $data]);
	}




	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('title');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::not_redirect();
			$html .= \content_site\options\generate::specialsave();;

	    	$html .= '<label for="caption">'. T_("Caption"). '</label>';

	    	$html .= \content_site\options\generate::text('opt_caption_gallery', $default, T_("Caption"));

		}
  		$html .= '</form>';

		return $html;
	}

}
?>