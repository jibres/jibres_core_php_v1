<?php
namespace content_site\options\video;


trait video_controls
{
	use video_option;

	public static function name()
	{
		return 'video_controls';
	}

	public static function title()
	{
		return T_("Controls");
	}


}
?>