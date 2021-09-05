<?php
namespace content_site\options\responsive;


class responsive_footer_btn_title
{
	public static function validator($_data)
	{
		$data = \dash\validate::string_50($_data);
		return $data;
	}

	public static function db_key()
	{
		return 'title';
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('title');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::text('opt_responsive_footer_btn_title', $default, T_("Button title (Maximum 10 character)"));

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>
