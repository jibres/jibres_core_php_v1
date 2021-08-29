<?php
namespace content_site\options\file;


trait file_avatar
{
	use file;


	public static function db_key()
	{
		return 'avatar';
	}

}
?>