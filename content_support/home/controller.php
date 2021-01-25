<?php
namespace content_support\home;

class controller
{
	public static function routing()
	{
		\dash\data::isHelpCenter(false);

		$module = \dash\url::module();
		if(in_array($module, ['ticket']))
		{

		}
		else
		{

			$directory = \dash\url::directory();
			$directory = \dash\validate::string_300($directory, false);

			if($directory)
			{
				$check_arg =
				[
					'type'   => 'help',
					'language' => \dash\language::current(),
					'slug'   => urldecode($directory),
					'limit'  => 1
				];

				$check_arg['status'] = 'publish';

				$check = \dash\db\posts::get($check_arg);
				if($check)
				{
					\dash\data::isHelpCenter(true);
					\dash\data::moduelRow($check);
					\dash\open::get();


				}

			}
		}
	}
}
?>
