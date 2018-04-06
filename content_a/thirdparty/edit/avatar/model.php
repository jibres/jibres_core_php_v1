<?php
namespace content_a\thirdparty\edit\avatar;


class model extends \content_a\main\model
{
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
			if(!\lib\engine\process::status())
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

		\lib\app\thirdparty::edit($request, \dash\request::get('id'));

		if(\lib\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
