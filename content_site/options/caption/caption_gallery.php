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
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
			$html .= \content_site\options\generate::specialsave();;
	    	$html .= \content_site\options\generate::text('opt_caption_gallery', $default, T_("Caption"));

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>