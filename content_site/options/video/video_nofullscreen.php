<?php
namespace content_site\options\video;


trait video_nofullscreen
{
	use video_option;

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