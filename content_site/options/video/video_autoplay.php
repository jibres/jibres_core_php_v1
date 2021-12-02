<?php
namespace content_site\options\video;


class video_autoplay extends video_option
{


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