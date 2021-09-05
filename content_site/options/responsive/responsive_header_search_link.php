<?php
namespace content_site\options\responsive;


class responsive_header_search_link
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'h_l_search'));
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(\content_site\utility::className(__CLASS__));

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::checkbox('h_l_search', T_('Display search link'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>