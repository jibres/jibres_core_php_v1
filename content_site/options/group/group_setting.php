<?php
namespace content_site\options\group;


class group_setting
{

	public static function admin_html()
	{
		$html = '';
		$html .= "<div class='-mx-7 -mt-7 mb-2 px-7 py-1 bg-gray-400 text-white'>";
		$html .= T_("Settings");
		$html .= "</div>";
		return $html;
	}

}
?>