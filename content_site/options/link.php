<?php
namespace content_site\options;


class link
{

	public static function validator($_data)
	{
		$data = \dash\validate::absolute_url($_data, true);
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('link');


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="not_redirect" value="1">';
	    	$html .= '<label for="link">'. T_("Link"). '</label>';

			$html .= '<div class="input ltr">';
			{
	    		$html .= '<input type="url" name="opt_link" value="'. $default. '">';
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>