<?php
namespace content_site\options;


class caption
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}


	public static function default()
	{
		return T_('Image caption');
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('caption');

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="not_redirect" value="1">';

	    	$html .= '<label for="caption">'. T_("Caption"). '</label>';

			$html .= '<div class="input">';
			{
	    		$html .= '<input type="text" placeholder="" name="opt_caption" value="'. $default. '">';
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>