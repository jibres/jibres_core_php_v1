<?php
namespace content_a\product\thumb;


class model
{


	public static function post()
	{
		if(\dash\request::post('delete') === 'thumb')
		{
			\lib\app\product\file::thumb(null, \dash\request::get('id'));
			\dash\notif::warn(T_("File removed"));
		}
		else
		{
			$file_url = \dash\app\file::upload_quick('thumb');
			// we have an error in upload thumb
			if(!$file_url)
			{
				\dash\notif::warn(T_("No file sended"));
				return false;
			}

			\lib\app\product\file::thumb($file_url, \dash\request::get('id'));
			\dash\notif::ok(T_("File successfully uploaded"));
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
