<?php
namespace content_site\options\video;


class video_clickable extends video_option
{

	public static function name()
	{
		return 'video_clickable';
	}

	public static function title()
	{
		return T_("Clickable");
	}

	public static function default()
	{
		return true;
	}



}
?>