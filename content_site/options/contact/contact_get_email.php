<?php
namespace content_site\options\contact;


class contact_get_email
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'get_email'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('contact_get_email');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_contact_get_email" value="1">';

	    	$html .= \content_site\options\generate::checkbox('get_email', T_('Get email'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>