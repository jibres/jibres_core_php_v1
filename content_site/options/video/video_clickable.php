<?php
namespace content_site\options\video;


trait video_clickable
{
	use video_option;

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