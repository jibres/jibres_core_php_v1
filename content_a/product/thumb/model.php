<?php
namespace content_a\product\thumb;


class model
{
	public static function upload_thumb()
	{
		if(\dash\request::files('thumb'))
		{
			$uploaded_file = \dash\app\file::upload(['debug' => false, 'upload_name' => 'thumb']);

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


	public static function post()
	{
		\dash\permission::access('aProductEdit');
		$file_url = self::upload_thumb();

		// we have an error in upload thumb
		if(!$file_url)
		{
			\dash\notif::warn(T_("No file sended"));
			return false;
		}

		$request          = [];
		$request['thumb'] = $file_url;

		\lib\app\product::edit($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
