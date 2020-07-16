<?php
namespace content_business\home;

class controller
{
	public static function routing()
	{
		$module = \dash\url::module();
		if(in_array($module, ['apk', 'app', 'comment']))
		{
			// nothing
		}
		else
		{
			$directory = \dash\url::directory();
			$directory = \dash\validate::string_300($directory, false);

			if($directory)
			{
				$check_arg =
				[
					'type'     => 'post',
					'language' => \dash\language::current(),
					'slug'     => urldecode($directory),
					'status'   => 'publish',
					'limit'    => 1
				];


				$check = \dash\db\posts::get($check_arg);

				if($check)
				{
					\dash\data::postIsLoaded(true);
					\dash\data::mydatarow($check);

					\dash\open::get();

				}

			}
		}
	}
}
?>