<?php
namespace content_site\options\video;


class video_controls extends video_option
{

	public static function name()
	{
		return 'video_controls';
	}

	public static function title()
	{
		return T_("Controls");
	}

	public static function default()
	{
		return true;
	}


}
?>