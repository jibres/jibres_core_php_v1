<?php
namespace content_site\options\video;


class video_muted extends video_option
{

	public static function name()
	{
		return 'video_muted';
	}

	public static function title()
	{
		return T_("Muted");
	}


}
?>