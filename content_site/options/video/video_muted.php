<?php
namespace content_site\options\video;


trait video_muted
{
	use video_option;

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