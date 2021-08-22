<?php
namespace content_site\options\file;


class file_gallery
{
	use file;


	public static function db_key()
	{
		return 'file';
	}



	public static function option_key()
	{
		return 'file_gallery';
	}


	public static function have_specialsave()
	{
		return true;
	}


	public static function specialsave($_data)
	{
		$file_path = self::validator($_data);

		if(!$file_path)
		{
			return false;
		}

		return \content_site\body\gallery\option::update_one_gallery_item(['file' => $file_path]);
	}

}
?>