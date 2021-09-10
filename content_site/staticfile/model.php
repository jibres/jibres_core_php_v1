<?php
namespace content_site\staticfile;


class model
{
	public static function post()
	{

		if(\dash\request::post('remove') === 'file')
		{
			$post =
			[
				'filename'    => \dash\request::post('name'),
			];

			$result = \lib\app\staticfile\remove::remove($post);
		}

		else
		{
			$post =
			[
				'filename'    => \dash\request::post('filename'),
				'filecontent' => \dash\request::post('filecontent'),
			];

			$result = \lib\app\staticfile\add::add($post);
		}

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>