<?php
namespace content_site\options;


class style
{
	public static function admin_html($_section_detail)
	{
		$html = '';
		$url = \dash\url::that(). '/style'. \dash\request::full_get();
		$html .= "<a href='$url' class='btn mt-10 block'>". T_("Personalization Desgin"). '</a>';
		return $html;
	}

}
?>