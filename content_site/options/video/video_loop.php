<?php
namespace content_site\options\video;


trait video_loop
{
	use video_option;

	public static function name()
	{
		return 'video_loop';
	}

	public static function title()
	{
		return T_("Loop");
	}


}
?>