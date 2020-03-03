<?php
namespace content_v2\doc;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\data::page_title( T_(':val API documentation v2', ['val' => \dash\data::site_title()]));
		\dash\data::page_desc(T_('Last modified'). ' '. \dash\datetime::fit('2019-02-21 17:30', 'human', 'year'));
		\dash\data::page_pictogram('campfire');

		$myStore = '{STORE}';
		if(\dash\url::store())
		{
			$myStore = \dash\url::store();
		}

		$CustomerApiURL = \dash\url::protocol(). '://api.jibres.'. \dash\url::tld(). '/'. \dash\language::current(). '/'. $myStore .'/v2/';
		\dash\data::CustomerApiURL($CustomerApiURL);

		$JibresApiURL = 'need to change it to core --';
		$JibresApiURL = \dash\url::protocol(). '://'. \dash\url::domain(). '/'. \dash\language::current(). '/api/v2/';
		\dash\data::JibresApiURL($JibresApiURL);

		$YourSubdomain = 'YourSubdomain';
		$YourAPPKey    = 'YourAPPKey';
		$YourApiKey    = 'YourApiKey';

		if(\dash\user::id())
		{
			$apikey = \dash\app\user_auth::get_apikey(\dash\user::id(), 'api');

			if(isset($apikey['auth']))
			{
				$YourApiKey = $apikey['auth'];
			}

			$appkey = \dash\app\user_auth::jibres_get_appkey(\dash\user::id());
			if(isset($appkey['auth']))
			{
				$YourAPPKey = $appkey['auth'];
			}

		}


		\dash\data::mySubdomain($YourSubdomain);
		\dash\data::myAppKey($YourAPPKey);
		\dash\data::myApiKey($YourApiKey);

		self::load_project_api_doc();
	}


	private static function load_project_api_doc()
	{
		$projectDoc     = [];
		$addr           = root. 'content_v2/doc';

		if(is_dir($addr))
		{
			$list = glob($addr . '/*');
			if($list && is_array($list))
			{
				foreach ($list as $key => $value)
				{


					if(substr($value, -10) === '000-public')
					{
						continue;
					}

					if(is_dir($value))
					{
						$folder_list = glob($value. '/*');
						if(is_array($folder_list))
						{
							foreach ($folder_list as $k => $v)
							{
								if(substr($v, -4) === '.php')
								{
									if(in_array(basename($v), ['view.php']))
									{
										continue;
									}
									else
									{
										$projectDoc[] = $v;
									}
								}
							}
						}
					}
					else
					{
						if(substr($value, -4) === '.php')
						{
							if(in_array(basename($value), ['view.php']))
							{
								continue;
							}
							else
							{
								$projectDoc[] = $value;
							}
						}
					}

				}
			}
		}

		\dash\data::projectDoc($projectDoc);
	}
}
?>