<?php
namespace content_site\options\heading;


class heading_business_footer
{
	use heading_business;

	public static function have_text_position()
	{
		return false;
	}


	public static function title()
	{
		return T_("Title");
	}

}
?>