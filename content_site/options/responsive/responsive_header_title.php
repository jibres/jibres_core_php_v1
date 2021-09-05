<?php
namespace content_site\options\responsive;


class responsive_header_title
{
	public static function validator($_data)
	{
		$data = \dash\validate::string_50($_data);
		return $data;
	}




	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('responsive_header_title');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::text('opt_responsive_header_title', $default, T_("Page title in mobile"));

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>
