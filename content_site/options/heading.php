<?php
namespace content_site\options;


class heading
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}


	public static function default()
	{
		return T_('Title');
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('heading');

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<label for="heading">'. T_("Heading"). '</label>';

			$html .= '<div class="input">';
			{
	    		$html .= '<input type="text" placeholder="" name="opt_heading" value="'. $default. '">';
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>