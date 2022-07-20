<?php
namespace content_cms\files\add;


class model
{
	public static function post()
	{
		if(\dash\request::files('file'))
		{

			$meta =
			[
				'allow_size' => \dash\upload\size::get(),
				'ext' =>
				[
					'mp3','wav','ogg','wma','m4a','aac', 	// audio
					'bmp','gif','jpeg','jpg','png','webp',	// image
					'mpeg','mpg','mp4','mov','avi',			// video
					'pdf',									// doc
					'zip', 'rar',							// zip

				],
			];


			$file_detail = \dash\upload\file::upload('file', $meta);

			if(!\dash\engine\process::status())
			{
				\dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				\dash\notif::ok(T_("File successfully uploaded"));
			}

			if(\dash\temp::get('isApi'))
			{
				return $file_detail;
			}
		}
		else
		{
			\dash\notif::error(T_("Please send a file to upload"));
			return false;
		}

		if(\dash\engine\process::status())
		{
			if(isset($file_detail['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/view?id='. \dash\coding::encode($file_detail['id']));
			}
			else
			{
				\dash\redirect::to(\dash\url::this(). '/datalist');
			}

		}
	}
}
?>
