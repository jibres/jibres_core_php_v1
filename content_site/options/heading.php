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
		return T_('New section');
	}


	public static function admin_html($_section_detail)
	{
		if(isset($_section_detail['preview']['heading']))
		{
			$default = $_section_detail['preview']['heading'];
		}
		else
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
    	$html .= '<input type="hidden" name="option" value="heading">';
    	$html .= '<label for="heading">'. T_("Heading"). '</label>';
		$html .= '<div class="input">';
    	$html .= '<input type="text" placeholder="" name="heading" value="'. $default. '">';
		$html .= "</div>";
  		$html .= '</form>';

		return $html;
	}

}
?>