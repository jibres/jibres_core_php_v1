<?php
namespace content_site\options\video;


trait video_nodownload
{
	use video_option;

	public static function name()
	{
		return 'video_nodownload';
	}

	public static function title()
	{
		return T_("No downalod");
	}


}
?>