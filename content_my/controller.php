<?php
namespace content_my;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login(true);

		\dash\redirect::remove_subdomain();

		if(\dash\request::get('utm_campaign') === 'pwa' && \dash\detect\device::detectPWA())
		{
			if(\dash\engine\store::inBusinessAdmin())
			{
				// if url contain business, redirect to business admin
				\dash\redirect::to(\dash\url::kingdom(). '/a');
			}
		}

		\dash\redirect::remove_store();
	}
}
?>
