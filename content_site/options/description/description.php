<?php
namespace content_site\options\description;


class description
{

	public static function validator($_data)
	{
		$data = \dash\validate::desc($_data);
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('description');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="not_redirect" value="1">';
	    	$html .= '<label for="description">'. T_("Description"). '</label>';
	    	$html .= '<textarea class="txt" name="opt_description" rows="3">';
	    	$html .= $default;
	    	$html .= '</textarea>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>