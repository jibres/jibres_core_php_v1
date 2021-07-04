<?php
namespace content_site\options;


class text
{

	public static function validator($_data)
	{
		$data = \dash\validate::desc($_data, true);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('text');

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<label for="text">'. T_("Text"). '</label>';

	    	$html .= '<textarea class="txt" name="opt_text" placeholder="'. T_("Enter your text here"). '" rows="5">'. $default .'</textarea>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>