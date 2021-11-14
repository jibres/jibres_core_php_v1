<?php
namespace content_site\options\video;


trait video_disablepictureinpicture
{
	use video_option;

	public static function name()
	{
		return 'video_disablepictureinpicture';
	}

	public static function title()
	{
		return T_("Disable picture in picture");
	}


}
?>