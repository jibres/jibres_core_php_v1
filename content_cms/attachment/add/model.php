<?php
namespace content_cms\attachment\add;


class model
{
	public static function post()
	{
		\dash\permission::access('cpPostsAdd');

		if(\dash\request::files('gallery'))
		{

			$meta =
			[
				'allow_size' => \dash\upload\size::cms_file_size(),
				'ext' =>
				[
					'mp3','wav','ogg','wma','m4a','aac', 	// audio
					'bmp','gif','jpeg','jpg','png',			// image
					'mpeg','mpg','mp4','mov','avi',			// video
				],
			];


			$file_detail = \dash\upload\file::upload('gallery', $meta);

			if(!\dash\engine\process::status())
			{
				\dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				\dash\notif::ok(T_("File successfully uploaded"));
			}
		}

		if(\dash\engine\process::status())
		{
			\dash\notif::direct();
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>
