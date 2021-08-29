<?php
namespace content_site\options\heading;


trait heading_business
{
	use heading;

	public static function have_text_position()
	{
		return true;
	}


	public static function include_business_title()
	{
		return true;
	}

}
?>