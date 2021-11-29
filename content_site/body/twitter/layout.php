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
			$tweet['content'] = self::remove_t_co_link(a($tweet, 'content'));

		}
		else
		{
			$tweet                = [];
			$tweet['channel']     = a($_args, 'channel');
			$tweet['twname']      = a($_args, 'twname');
			$tweet['twusername']  = a($_args, 'twusername');
			$tweet['twavatar']    = a($_args, 'twavatar');
			$tweet['twverified']  = a($_args, 'twverified');
			$tweet['twcreatedat'] = a($_args, 'twcreatedat');
			$tweet['content']     = self::remove_t_co_link(a($_args, 'twcontent'));
			$tweet['twthumb']     = a($_args, 'twthumb');
		}



		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args, $tweet);
	}


}
?>