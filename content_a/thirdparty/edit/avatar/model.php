<?php
namespace content_a\thirdparty\edit\avatar;


class model extends \content_a\main\model
{
	public static function upload_avatar()
	{
		if(\lib\utility::files('avatar'))
		{
			$uploaded_file = \lib\app\file::upload(['debug' => false, 'upload_name' => 'avatar']);

			if(isset($uploaded_file['url']))
			{
				return $uploaded_file['url'];
			}
			// if in upload have error return
			if(!\lib\notif::$status)
			{
				return false;
			}
		}
		return null;
	}


	public function post_avatar($_args)
	{
		$file_url     = self::upload_avatar();

		// we have an error in upload avatar
		if($file_url === false)
		{
			return false;
		}

		$request           = [];
		$request['avatar'] = $file_url;

		\lib\app\thirdparty::edit($request, \lib\request::get('id'));

		if(\lib\notif::$status)
		{
			\lib\redirect::pwd();
		}
	}
}
?>
