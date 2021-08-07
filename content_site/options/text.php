<?php
namespace content_site\options;


class text
{

	public static function validator($_data)
	{
		$data = \dash\validate::desc($_data, true);
		return $data;
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('text');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="not_redirect" value="1">';

	    	$html .= '<label for="text">'. T_("Text"). '</label>';

	    	$html .= '<textarea class="txt" name="opt_text" placeholder="'. T_("Enter your text here"). '" rows="5">'. $default .'</textarea>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>