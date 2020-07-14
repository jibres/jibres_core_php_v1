<?php
namespace content_a\setting\telegram\bot;
// use telegram class as bot
use \dash\social\telegram\tg as bot;

class model
{
	public static function post()
	{
		$newApiKey = \dash\request::post('apikey');
		if(strlen($newApiKey) < 30 || strlen($newApiKey) > 70)
		{
			\dash\notif::error(T_('Please enter valid api token!'));
			return;
		}

		$post           = [];
		$post['apikey'] = $newApiKey;

		if($newApiKey)
		{
			// check api key is correct or not
			bot::$api_token = $newApiKey;
			$botDetail = bot::getMe();
			if(isset($botDetail['ok']) && $botDetail['ok'] === true)
			{
				// sample of output if it's okay

				if(isset($botDetail['result']['username']))
				{
					// @todo @reza save username of bot
					$post['username'] = $botDetail['result']['username'];

					// try to save and redirect
					\lib\app\setting\set::telegram_setting($post);
					\dash\redirect::pwd();
				}
			}
			elseif(isset($botDetail['error_code']))
			{
				// we have error
				if(isset($botDetail['description']))
				{
					if($botDetail['description'] === 'Unauthorized')
					{
						\dash\notif::error(T_("This token is invalid!"). ' - '. $botDetail['error_code']);
					}
					else
					{
						\dash\notif::error(T_($botDetail['description']). ' - '. $botDetail['error_code']);
					}
				}
				else
				{
					\dash\notif::error(T_('We have a problem with this token!'). ' - '. $botDetail['error_code']);
				}
			}
			else
			{
				\dash\notif::error(T_('We have a problem with this token!'));
			}
		}

	}
}
?>