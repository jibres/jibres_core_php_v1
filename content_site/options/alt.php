<?php
namespace content_site\options;


class alt
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}


	public static function default()
	{
		return T_('Image alt');
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['alt']))
		{
			$default = $_section_detail['preview']['alt'];
		}
		else
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
	    	$html .= '<input type="hidden" name="option" value="alt">';
	    	$html .= '<label for="alt">'. T_("Heading"). '</label>';

			$html .= '<div class="input">';
			{
	    		$html .= '<input type="text" placeholder="" name="alt" value="'. $default. '">';
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>