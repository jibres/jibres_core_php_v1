<?php
namespace content_site\options;


class description
{

	public static function validator($_data)
	{
		$data = \dash\validate::desc($_data);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('description');

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="option" value="description">';
	    	$html .= '<label for="description">'. T_("Description"). '</label>';
	    	$html .= '<textarea class="txt" rows="3">';
	    	$html .= $default;
	    	$html .= '</textarea>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>