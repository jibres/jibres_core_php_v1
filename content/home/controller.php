<?php
namespace content\home;

class controller
{

	// for routing check
	public static function routing()
	{
		self::alias_module_redirect();

		if(\dash\request::get('utm_campaign') === 'pwa' && \dash\detect\device::detectPWA())
		{
			if(\dash\user::id())
			{
				if(\dash\engine\store::inBusinessAdmin())
				{
					\dash\redirect::to(\dash\url::kingdom(). '/a');
				}
				else
				{
					\dash\redirect::to(\dash\url::kingdom(). '/my');
				}
			}
			else
			{
				\dash\redirect::to_login(true);
			}
		}


		if(\dash\url::store())
		{
			if(\dash\url::module() === 'apk' && !\dash\url::child())
			{
				\lib\app\application\download::from_site();
			}

			$module = \dash\url::module();
			if(!\dash\url::child() && $module && substr($module, 0, 1) === ':' && \dash\validate::id(substr($module, 1), false))
			{
				$factor_id = \dash\validate::id(substr($module, 1), false);
				$new_url = \dash\url::kingdom(). '/a/order/detail?id='. $factor_id;
				\dash\redirect::to($new_url);
				return;
			}

			\dash\redirect::to(\dash\url::kingdom(). '/a');
		}
	}

	public static function alias_module_redirect()
	{
		switch (\dash\url::directory())
		{
			case 'investment':
			case 'business-plan':
			case 'businessplan':
			case 'bp':
				\dash\redirect::to(\dash\url::kingdom(). '/business_plan');
				break;

			default:
				// nothing
				break;
		}
	}
}
?>