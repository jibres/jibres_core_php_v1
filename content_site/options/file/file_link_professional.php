<?php
namespace content_site\options\file;


class file_link_professional extends file
{


	public static function db_key()
	{
		return 'file';
	}


	public static function have_specialsave()
	{
		return true;
	}


	public static function upload_video()
	{
		return true;
	}


	public static function add_form_element()
	{
		return false;
	}

	public static function option_key()
	{
		return 'file';
	}


	public static function hidden_input()
	{
		return false;
	}



	public static function specialsave($_data)
	{
		$file_path = static::validator($_data);

		if(!\dash\engine\process::status())
		{
			return false;
		}

		return \content_site\body\gallery\option::update_one_gallery_item(['file' => $file_path]);
	}


}
?>