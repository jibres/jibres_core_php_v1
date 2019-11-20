<?php
namespace content_a;


class controller
{
	public static function routing()
	{
		if(!\dash\url::subdomain())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		// check user is login
		\dash\redirect::to_login();

		\dash\permission::access('contentA');

		// \lib\app\store\timeline::set('loadstore', \lib\store::id());
		\dash\session::clean('myNewStoreSubdomain');
		\dash\session::clean('myNewStoreID');

		self::check_setup_page();

	}


	private static function check_setup_page()
	{
		if(\dash\url::module() !== 'setup')
		{
			$complete = \lib\app\setting\setup::complete();
			if(!$complete)
			{
				$url = \dash\url::here(). '/setup';
				\dash\redirect::to($url);
			}
		}
	}
}
?>
