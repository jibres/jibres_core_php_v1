<?php
namespace content_site\options\contact;


class contact_get_name
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'get_name'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('contact_get_name');

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_contact_get_name" value="1">';
			$html .= '<div class="check1 py-0">';
			{
				$html .= '<input type="checkbox" name="get_name" id="contact_get_name"'.$checked.'>';
				$html .= '<label for="contact_get_name">'. T_('Get name'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>