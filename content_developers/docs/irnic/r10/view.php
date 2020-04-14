<?php
namespace content_developers\docs\irnic\r10;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\face::title( T_('Jibres IRNIC API'));
		\dash\face::desc(T_('Last modified'). ' '. \dash\datetime::fit('2020-04-06 18:57', 'human', 'year'));

		$tld = 'com';

		if(\dash\url::isLocal())
		{
			$tld = 'local';
		}
		elseif(\dash\language::current() === 'fa')
		{
			$tld = 'ir';
		}

		$IRNICApiURL = \dash\url::protocol(). '://core.jibres.'. $tld. '/r10/irnic/';

		\dash\data::IRNICApiURL($IRNICApiURL);
		\dash\data::endPoint($IRNICApiURL);


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

		\dash\data::myAppKey($YourAPPKey);
		\dash\data::myApiKey($YourApiKey);

		self::load_project_api_doc();
	}


	private static function load_project_api_doc()
	{
		$projectDoc     = [];
		$addr           = root. 'content_developers/docs/irnic/r10';

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