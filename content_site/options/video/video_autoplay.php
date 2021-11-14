<?php
namespace content_site\options\video;


trait video_autoplay
{
	use video_option;

	public static function name()
	{
		return 'video_autoplay';
	}

	public static function title()
	{
		return T_("Auto play");
	}


}
?>