<?php
namespace content_site\options\heading;


class heading_business extends heading
{

	public static function have_text_position()
	{
		return false;
	}


	public static function include_business_title()
	{
		return true;
	}

}
?>