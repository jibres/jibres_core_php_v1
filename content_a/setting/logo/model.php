<?php
namespace content_a\setting\logo;


class model
{
	public static function post()
	{
		$upload = self::upload_logo();

		if($upload)
		{
			\lib\app\store::edit_logo($upload);
		}
		else
		{
			\dash\notif::error(T_("No file was sended"), 'logo');
			return false;
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function upload_logo()
	{
		if(\dash\request::files('logo'))
		{
			$uploaded_file = \dash\app\file::upload(['debug' => false, 'upload_name' => 'logo']);

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