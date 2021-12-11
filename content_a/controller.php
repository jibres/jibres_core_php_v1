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


		if(!\dash\permission::has_permission())
		{
			\dash\permission::deny();
		}


		if(\dash\request::get('bigopening'))
		{
			\lib\app\store\config::first_setup();
		}

		if(\dash\request::get('bigopening') && \dash\request::get('domain') && !\dash\url::module())
		{
			\lib\app\store\config::first_setup_domain();
		}

		if(\dash\request::get('domain') && !\dash\url::module())
		{
			\dash\redirect::to(\dash\url::this(). '/setting/domain/existdomain?'. \dash\request::fix_get());
		}
	}
}
?>
