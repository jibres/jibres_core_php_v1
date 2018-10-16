<?php
namespace content_a\product\gallery;


class model
{

	public static function post()
	{
		if(self::upload_gallery())
		{
			return false;
		}

		if(\dash\request::post('type') === 'remove_gallery')
		{
			self::remove_gallery();
			return false;
		}
	}


	public static function upload_gallery()
	{
		if(\dash\request::files('gallery'))
		{
			$uploaded_file = \dash\app\file::upload(['debug' => false, 'upload_name' => 'gallery']);

			if(isset($uploaded_file['url']))
			{
				// save uploaded file
				\lib\app\product\file::gallery(\dash\request::get('id'), $uploaded_file['url'], 'add');
			}

			if(!\dash\engine\process::status())
			{
				\dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				\dash\notif::ok(T_("File successfully uploaded"));
			}

			return true;
		}
		return false;

	}


	public static function remove_gallery()
	{
		$id = \dash\request::post('id');
		if(!is_numeric($id))
		{
			return false;
		}

		\lib\app\product\file::gallery(\dash\request::get('id'), $id, 'remove');
		\dash\redirect::pwd();
	}


}
?>
