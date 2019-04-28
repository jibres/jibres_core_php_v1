<?php
namespace content_a\setting\logo;


class model
{
	public static function post()
	{
		$result = null;

		$logo = self::upload_logo('logo');

		if($logo)
		{
			$result = \lib\app\store::edit_logo($logo, 'logo');
		}

		$fav = self::upload_logo('fav');

		if($fav)
		{
			$result = \lib\app\store::edit_logo($fav, 'fav');
		}

		if(!$result)
		{
			\dash\notif::warn(T_("No file was sended"));
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function upload_logo($_name)
	{
		if(\dash\request::files($_name))
		{
			$uploaded_file = \dash\app\file::upload(['debug' => false, 'upload_name' => $_name]);

			if(isset($uploaded_file['url']))
			{
				return $uploaded_file['url'];
			}
			// if in upload have error return
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}
		return null;
	}
}
?>