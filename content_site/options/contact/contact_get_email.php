<?php
namespace content_site\options\contact;


class contact_get_email
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'get_email'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('contact_get_email');

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_contact_get_email" value="1">';

	    	$html .= \content_site\options\generate::checkbox('get_email', T_('Get email'), $default);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>