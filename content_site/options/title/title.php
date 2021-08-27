<?php
namespace content_site\options\title;


class title
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}




	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('title');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::not_redirect();

	    	$html .= '<label for="title">'. T_("Title"). '</label>';

			$html .= '<div class="input">';
			{
	    		$html .= '<input type="text" placeholder="" name="opt_title" value="'. $default. '">';
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>