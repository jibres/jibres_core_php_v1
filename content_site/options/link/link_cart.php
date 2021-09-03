<?php
namespace content_site\options\link;


class link_cart
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'my_link_cart'));
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
			$html .= \content_site\options\generate::checkbox('my_link_cart', T_('Display cart link'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>