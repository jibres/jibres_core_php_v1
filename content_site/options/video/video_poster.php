<?php
namespace content_site\options\video;


trait video_poster
{
	use \content_site\options\file\file;

	public static function db_key()
	{
		return 'video_poster';
	}

	public static function have_label()
	{
		return true;
	}


	public static function label()
	{
		return T_("Video poster");
	}

}
?>