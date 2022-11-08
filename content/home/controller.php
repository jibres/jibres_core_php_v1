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

		// self::detect_jibres_website_pagebuilder();
	}


	private static function alias_module_redirect()
	{
		switch (\dash\url::directory())
		{
			case 'business_plan':
			case 'business-plan':
			case 'businessplan':
			case 'bp':
				\dash\redirect::to(\dash\url::kingdom(). '/investment');
				break;

			case 'pitchdeck':
				\dash\redirect::to(\dash\url::kingdom(). '/investment/pitchdeck');
				break;

			case 'status':
			case 'uptime':

				\dash\redirect::to('https://stats.uptimerobot.com/znLJpflDQ'); // reza
				// \dash\redirect::to('https://stats.uptimerobot.com/39MgXFm7x7'); // javad
				break;

			case 'price':
			case 'pricing':
			case 'plan':
			case 'plans':
				\dash\redirect::to(\dash\url::kingdom(). '/free');
				break;

			default:
			// nothing
				break;
		}
	}


	/**
	 * Check is path exist in jibres business page builder
	 */
	private static function detect_jibres_website_pagebuilder()
	{
		// https://jibres.ir/$jbjkb/a
		$jibres_business_id = 1001208;
		if(\dash\language::current() === 'en')
		{
			$jibres_business_id = 1001209;
		}

		if(\dash\url::isLocal())
		{
			$jibres_business_id = 1000005;
		}

		// lock on jibres business
		\dash\engine\store::force_lock_id($jibres_business_id);

		\dash\temp::set('ForceLoadSiteBuilderForJibres', true);

		// \dash\open::get();
		// \dash\engine\template::find();
		\dash\layout\business::check_website();

		// unlock from jibres business
		// \dash\engine\store::unlock();

	}
}
?>