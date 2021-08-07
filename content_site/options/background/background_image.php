<?php
namespace content_site\options\background;


class background_image
{
	use \content_site\options\file\file;


	public static function db_key()
	{
		return 'background_image';
	}



	public static function option_key()
	{
		return 'background_image';
	}
}
?>