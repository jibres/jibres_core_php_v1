<?php
namespace content_site\options;


class seperator
{

	public static function validator($_data)
	{
		return;
	}


	public static function default()
	{
		return;
	}


	public static function admin_html($_section_detail)
	{
		$html = '<hr class="mTB20">';
		return $html;
	}

}
?>