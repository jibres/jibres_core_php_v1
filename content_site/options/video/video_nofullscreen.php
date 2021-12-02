<?php
namespace content_site\options\video;


class video_nofullscreen extends video_option
{

	public static function name()
	{
		return 'video_nofullscreen';
	}

	public static function title()
	{
		return T_("No fullscreen");
	}


}
?>