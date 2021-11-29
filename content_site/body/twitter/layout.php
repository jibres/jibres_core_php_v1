<?php
namespace content_site\body\twitter;


class layout
{

	private static function remove_t_co_link($_content)
	{
		return preg_replace("/https\:\/\/t\.co\/([^\s]+)/", '', $_content);
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

			$tweet['twusername']  = a($tweet, 'socialpostdetail', 'twusername');
			$tweet['twname']      = a($tweet, 'socialpostdetail', 'twname');
			$tweet['twavatar']    = a($tweet, 'socialpostdetail', 'twavatar');
			$tweet['twverified']  = a($tweet, 'socialpostdetail', 'twverified');
			$tweet['twcreatedat'] = a($tweet, 'socialpostdetail', 'twcreatedat');
			$tweet['twthumb'] = a($tweet, 'thumb');
			$tweet['twcontent'] = self::remove_t_co_link(a($tweet, 'content'));

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