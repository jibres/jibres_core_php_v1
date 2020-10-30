<?php
namespace content_a;


class controller
{
	public static function routing()
	{
		if(!\dash\url::store())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		// check user is login
		\dash\redirect::to_login();


		\dash\permission::has_permission();


		if(\dash\request::get('bigopening'))
		{
			\lib\app\store\config::first_setup();
		}


		if(\dash\request::get('domain') && !\dash\url::module())
		{
			\dash\redirect::to(\dash\url::this(). '/setting/domain/existdomain?'. \dash\request::fix_get());
		}
		// self::check_setup_page();

	}


	private static function check_setup_page()
	{
		$check_once = \dash\session::get('checkStoreSetupOnce_'.\lib\store::id());
		if(!$check_once)
		{
			\dash\session::set('checkStoreSetupOnce_'.\lib\store::id(), true);

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
}
?>
