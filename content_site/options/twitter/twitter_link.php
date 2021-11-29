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

		// if($default !== $current)
		{
			$fetch = \lib\app\twitter\business::lookup_tweet($explode[0], $explode[2]);

			if(!$fetch || !a($fetch, 'result'))
			{
				\dash\notif::warn(T_("Cannot fetch tweet now!"));
			}
			else
			{
				$fetch_result         = $fetch['result'];

				$user_detail = a($fetch, 'result', 'user_detail', 'data');
				$tweet       = a($fetch, 'result', 'tweet');

				$save['channel']        = a($user_detail, 'username');
				$save['twname']         = a($user_detail, 'name');
				$save['twusername']     = a($user_detail, 'username');
				$save['twavatar']       = a($user_detail, 'profile_image_url');
				$save['twverified']     = a($user_detail, 'verified');
				$save['twcreatedat']    = a($tweet, 'data', 'created_at');
				$save['twcontent']      = a($tweet, 'data', 'text');
				$save['twlang']         = a($tweet, 'data', 'lang');
				$media        = a($tweet, 'includes', 'media');
				if(a($media, 0, 'preview_image_url'))
				{
					$save['twthumb']        = a($media, 0, 'preview_image_url');
				}
				else
				{
					$save['twthumb']        = a($media, 0, 'url');
				}

				$entities               = a($tweet, 'data', 'entities');

				$save['twurl']          = a($entities, 'urls', 0, 'url');

				$save['twlikescount']   = a($tweet, 'data', 'public_metrics', 'like_count');
				$save['twreplycount']   = a($tweet, 'data', 'public_metrics', 'reply_count');
				$save['twretweetcount'] = a($tweet, 'data', 'public_metrics', 'retweet_count');
				$save['twquotecount']   = a($tweet, 'data', 'public_metrics', 'quote_count');
			}
			// var_dump($fetch);
			// var_dump($save);exit;

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