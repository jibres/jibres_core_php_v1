<?php
namespace content_site\options\caption;


class caption
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}




	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('caption');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::text('opt_caption', $default, T_("Caption"));

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>