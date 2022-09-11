<?php
namespace content_site\body\twitter;


class layout
{

	private static function remove_t_co_link($_content)
	{
		return preg_replace("/https\:\/\/t\.co\/([^\s]+)/", '', strval($_content));
	}

	/**
	 * Layout twitter html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		if(a($_args, 'twitter') === 'myself')
		{
			$tweet = \lib\app\twitter\business::get_my_posts(['limit' => 1]);
			if(isset($tweet[0]))
			{
				$tweet = $tweet[0];
			}

			if(is_array(a($tweet, 'socialpostdetail')))
			{
				foreach ($tweet['socialpostdetail'] as $key => $value)
				{
					if(substr($key, 0,2) === 'tw')
					{
						$tweet[$key] = $value;
					}
				}
			}

			if(is_array(a($tweet, 'socialpostdetail', 'tweet')))
			{
				foreach ($tweet['socialpostdetail']['tweet'] as $key => $value)
				{
					if(substr($key, 0,2) === 'tw')
					{
						$tweet[$key] = $value;
					}
				}
			}

			if(is_array(a($tweet, 'socialpostdetail', 'user_detail')))
			{
				foreach ($tweet['socialpostdetail']['user_detail'] as $key => $value)
				{
					if(substr($key, 0,2) === 'tw')
					{
						$tweet[$key] = $value;
					}
				}
			}

			$tweet['twcontent'] = self::remove_t_co_link(a($tweet, 'twcontent'));


		}
		else
		{
			$tweet                = [];
			foreach ($_args as $key => $value)
			{
				if(substr($key, 0,2) === 'tw')
				{
					$tweet[$key] = $value;
				}
			}
			$tweet['channel']     = a($_args, 'channel');
			$tweet['twcontent']     = self::remove_t_co_link(a($_args, 'twcontent'));
		}



		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args, $tweet);
	}


}
?>