<?php
namespace content_site\options\contact;


class contact_get_mobile
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'get_mobile'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('contact_get_mobile');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::checkbox('get_mobile', T_('Get mobile'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>