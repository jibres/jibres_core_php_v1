<?php
namespace content_site\options\link;


class link_search
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'my_link_search'));
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(\content_site\utility::className(get_called_class()));

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::checkbox('my_link_search', T_('Display search link'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>