<?php
namespace content_api\v1\doc;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\data::page_title( T_(':val API documentation v1', ['val' => \dash\data::site_title()]));
		\dash\data::page_desc(T_('Last modified'). ' '. \dash\datetime::fit('2019-02-21 17:30', 'human', 'year'));
		\dash\data::page_pictogram('campfire');

		$CustomerApiURL = \dash\url::protocol(). '://'. \dash\url::domain(). '/'. \dash\language::current(). '/api/v1/{STORE}/';
		\dash\data::CustomerApiURL($CustomerApiURL);

		$JibresApiURL = \dash\url::protocol(). '://'. \dash\url::domain(). '/'. \dash\language::current(). '/api/v1/';
		\dash\data::JibresApiURL($JibresApiURL);

		$YourSubdomain = 'YourSubdomain';
		$YourAPPKey    = 'YourAPPKey';
		$YourApiKey    = 'YourApiKey';

		// if(\dash\user::id())
		// {
		// 	$apikey = \dash\app\user_auth::get_apikey(\dash\user::id(), 'api');
		// 	if(isset($apikey['auth']))
		// 	{
		// 		$YourApiKey = $apikey['auth'];
		// 	}

		// 	$appkey = \dash\app\user_auth::get_appkey(\dash\user::id());
		// 	if(isset($appkey['auth']))
		// 	{
		// 		$YourAPPKey = $appkey['auth'];
		// 	}

		// }


		\dash\data::mySubdomain($YourSubdomain);
		\dash\data::myAppKey($YourAPPKey);
		\dash\data::myApiKey($YourApiKey);

		self::load_project_api_doc();
	}


	private static function load_project_api_doc()
	{
		$projectDoc     = [];
		$addr           = root. 'content_api/v1/doc';

		if(is_dir($addr))
		{
			$list = glob($addr . '/*');
			if($list && is_array($list))
			{
				foreach ($list as $key => $value)
				{
					if(substr($value, -5) === '.html')
					{
						if(in_array(basename($value), ['display.html', 'view.php']))
						{
							continue;
						}
						else
						{
							$projectDoc[] = str_replace(root, '', $value);
						}
					}

				}
			}
		}

		\dash\data::projectDoc($projectDoc);
	}
}
?>