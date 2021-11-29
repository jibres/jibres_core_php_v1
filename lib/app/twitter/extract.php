<?php
namespace lib\app\twitter;

class extract
{

	private static function get_media($_data)
	{
		$media = a($_data, 'includes', 'media');
		if(!is_array($media))
		{
			$media = [];
		}

		return $media;
	}

	public static function user_detail($_data)
	{
		$user_detail = [];
		$user_detail['channel']        = a($_data, 'data', 'username');
		$user_detail['twname']         = a($_data, 'data', 'name');
		$user_detail['twusername']     = a($_data, 'data', 'username');
		$user_detail['twavatar']       = a($_data, 'data', 'profile_image_url');
		$user_detail['twverified']     = a($_data, 'data', 'verified');
		return $user_detail;
	}


	public static function tweet_detail($_data, $_multiple = false)
	{
		$tweet = [];

		if($_multiple)
		{
			$my_data = $_data;
		}
		else
		{
			$my_data = a($_data, 'data');
		}

		$tweet['twcreatedat']    = a($my_data, 'created_at');
		$tweet['twcontent']      = a($my_data, 'text');
		$tweet['twid']      = a($my_data, 'id');
		$tweet['twlang']         = a($my_data, 'lang');
		$media        = self::get_media($_data);
		if(a($media, 0, 'preview_image_url'))
		{
			$tweet['twthumb']        = a($media, 0, 'preview_image_url');
		}
		else
		{
			$tweet['twthumb']        = a($media, 0, 'url');
		}

		$entities               = a($my_data, 'entities');

		$tweet['twurl']          = a($entities, 'urls', 0, 'url');

		$tweet['twlikescount']   = a($my_data, 'public_metrics', 'like_count');
		$tweet['twreplycount']   = a($my_data, 'public_metrics', 'reply_count');
		$tweet['twretweetcount'] = a($my_data, 'public_metrics', 'retweet_count');
		$tweet['twquotecount']   = a($my_data, 'public_metrics', 'quote_count');

		return $tweet;

	}


	public static function multi_tweet($_data)
	{
		$media = self::get_media($_data);

		$media = array_combine(array_column($media, 'media_key'), $media);

		$tweets_raw = a($_data, 'data');

		if(!is_array($tweets_raw))
		{
			$tweets_raw = [];
		}

		$tweets = [];

		foreach ($tweets_raw as $key => $tweet)
		{
			$tweets[$key] = self::tweet_detail($tweet, true);
			$tweets[$key]['raw'] = $tweet;
		}

		return $tweets;
	}

}
?>