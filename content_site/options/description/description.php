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
			$html .= \content_site\options\generate::not_redirect();
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