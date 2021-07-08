<?php
namespace content_site\options\group;


class group_filter
{

	public static function admin_html()
	{
		$html = '';
		$html .= "<div class='-mx-7 mt-8 mb-2 px-7 py-1 bg-gray-400 text-white'>";
		$html .= T_("Filters");
		$html .= "</div>";
		return $html;
	}

}
?>