<?php
namespace content\app;


class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			$link = null;
			switch (\dash\url::child())
			{
				case 'android':
					$link = 'https://play.google.com/store/apps/details?id=com.jibres';
					if(\dash\language::current() === 'fa')
					{
						$link .= '&hl=fa';
					}
					break;

				case 'direct':
					$link = \dash\url::set_subdomain('jibres'). '/apk';
					break;

				case 'cafebazaar':
					$link = null;
					break;

				case 'myket':
					$link = null;
					break;

				case 'charkhoneh':
					$link = null;
					break;


				case 'pwa':
					$link = null;
					break;

				case 'ios':
					$link = \dash\url::kingdom(). '/app/pwa';
					break;

				default:
					$link = null;
					break;
			}

			// try to redirect
			if($link)
			{
				\dash\redirect::to($link);
			}

		}
	}
}
?>