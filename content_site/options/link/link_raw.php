<?php
namespace content_site\options\link;


class link_raw
{

	public static function validator($_data)
	{
		$data = \dash\validate::absolute_url($_data, true);
		return $data;
	}

	public static function db_key()
	{
		return 'link';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('link');


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::not_redirect();;
	    	$html .= '<label for="link">'. T_("Link"). '</label>';

			$html .= '<div class="input ltr">';
			{
	    		$html .= '<input type="url" name="opt_link_raw" value="'. $default. '">';
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>