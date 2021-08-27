<?php
namespace content_site\options\contact;


class contact_get_mobile
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'get_mobile'));
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
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_contact_get_mobile" value="1">';

			$html .= \content_site\options\generate::checkbox('get_mobile', T_('Get mobile'), $default);
		}

  		$html .= '</form>';

		return $html;
	}

}
?>