<?php
namespace content\home;

class controller
{

	/**
	 * the static page to not run any query
	 * and brand black list
	 * @var        array
	 */
	public static  $static_pages =
	[
		'benefits',
		'pricing',
		'jibres',
		'help',
		'admin',
		'enter',
		'about',
		'social-responsibility',
		'terms',
		'privacy',
		'changelog',
		'logo',
		'contact',
		'api',
		// brand black list
		'branch',
		'team',
		'member',
		'add',
		'edit',
		'delete',
		'user',
		'hours',
		'report',
		'last',
		'daily',
		'account',
		'for',
		'files',

	];

	// for routing check
	public static function routing()
	{
		if(\dash\url::store())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/a');
		}

		if(\dash\user::id())
		{
			if(\dash\detect\device::detectPWA())
			{
				// \dash\redirect::to(\dash\url::kingdom(). '/dashboard');
			}
		}

		// if on homepage return false
		$url = \dash\url::directory();
		if(!$url)
		{
			return false;
		}
		// if the url in static page [and black list] return
		if(in_array($url, self::$static_pages))
		{
			return;
		}

	}
}
?>