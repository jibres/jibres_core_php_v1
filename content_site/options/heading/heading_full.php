<?php
namespace content_site\options\heading;


class heading_full
{
	use heading;

	public static function have_text_position()
	{
		return true;
	}

	public static function option_key()
	{
		return 'heading_full';
	}


}
?>