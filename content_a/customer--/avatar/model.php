<?php
namespace content_a\customer\avatar;


class model
{
	public static function post()
	{
		$request           = [];
		if(\dash\request::post('remove') === 'avatar')
		{
			\dash\permission::access('customerAvatarDelete');

			$request['avatar'] = null;
		}
		else
		{
			$file_url = self::upload_avatar();

			// we have an error in upload avatar
			if(!$file_url)
			{
				\dash\notif::warn(T_("No file sended"));
				return false;
			}

			$request['avatar'] = $file_url;
		}

		\lib\app\customer::edit($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function upload_avatar()
	{
		if(\dash\request::files('avatar'))
		{
			$uploaded_file = \dash\app\file::upload(['debug' => false, 'upload_name' => 'avatar']);

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
