<?php
namespace content_a\accounting\year\import;

class model
{
	public static function post()
	{

		if(!\dash\request::files('import'))
		{
			\dash\notif::error(T_("Please Upload a file"));
			return false;
		}

		$data = \dash\upload\quick::read_csv('import');

		if(!$data)
		{
			\dash\notif::error(T_("No data was received!"));
			return false;
		}

		\dash\notif::warn(T_("Not ready yet!"));
		return false;

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\tax\year\remove::remove(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
			return;
		}


		$post =
		[
			'title'     => \dash\request::post('title'),
		];

		$result = \lib\app\tax\year\edit::edit($post, \dash\request::get('id'));


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
