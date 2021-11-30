<?php
namespace content_site\options\twitter;


class twitter_link
{

	public static function extends_option()
	{
		return twitter::extends_option();
	}


	public static function validator($_data)
	{
		$data = \dash\validate::external_url($_data, true);
		if(!$data)
		{
			return null;
		}

		$parse_url = \dash\validate\url::parseUrl($data);
		if(a($parse_url, 'domain') !== 'twitter.com')
		{
			\dash\notif::error(T_("Please set a valid tweet url"));
			return false;
		}
		$path    = a($parse_url, 'path');
		$path    = trim($path, '/');
		$explode = explode('/', $path);

		if(is_string(a($explode, 0)) && a($explode, 1) === 'status' && is_numeric(a($explode, 2)))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Please set a valid tweet url"));
			return false;
		}

		$default = \content_site\section\view::get_current_index_detail('twitter_link');
		$current = 'https://twitter.com/'. $path;

		$save = [];

		$twlastfetch = \content_site\section\view::get_current_index_detail('twitter_link');
		if(!$twlastfetch)
		{
			$twlastfetch = time();
		}

		if($default !== $current || (time() - strtotime($twlastfetch) > (60*60)))
		{
			$save['twlastfetch'] = date("Y-m-d H:i:s");

			$fetch = \lib\app\twitter\business::lookup_tweet($explode[0], $explode[2]);

			if(!$fetch || !a($fetch, 'result'))
			{
				\dash\notif::warn(T_("Cannot fetch tweet now!"));
			}
			else
			{
				$fetch_result         = $fetch['result'];

				$user_detail = a($fetch, 'result', 'user_detail');
				$tweet       = a($fetch, 'result', 'tweet');

				$save = array_merge($save, \lib\app\twitter\extract::user_detail($user_detail));
				$save = array_merge($save, \lib\app\twitter\extract::tweet_detail($tweet));

			}

		}


		$save['twitter_link'] = $current;

		return $save;

	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('twitter_link');

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
			$html .= \content_site\options\generate::text('opt_twitter_link', $default, T_("Tweet link"), null, 'ltr', 'url');
		}
  		$html .= \content_site\options\generate::_form();
		return $html;
	}

}
?>