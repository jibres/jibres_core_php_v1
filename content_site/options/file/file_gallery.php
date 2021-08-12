<?php
namespace content_site\options\file;


class file_gallery
{
	use file;


	public static function db_key()
	{
		return 'image';
	}



	public static function option_key()
	{
		return 'file_gallery';
	}
}
?>