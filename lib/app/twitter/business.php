<?php
namespace lib\app\twitter;

class business
{

	/**
	 * Call jibres api to get login url
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function login_url()
	{
		$url = \lib\api\jibres\api::get_twitter_login_url();

		if(!$url || !isset($url['result']['login_url']))
		{
			return false;
		}

		return $url['result']['login_url'];
	}


	public static function remove_token()
	{
		\lib\db\setting\update::overwirte_cat_key(null, 'twitter', 'access_token');
		\lib\db\setting\update::overwirte_cat_key(null, 'twitter', 'user_id');

		\dash\notif::ok(T_("Connection removed"));
		return true;
	}




	public static function user_id()
	{
		$load = \lib\db\setting\get::by_cat_key('twitter', 'user_id');
		if(isset($load['value']))
		{
			return $load['value'];
		}

		return null;
	}


	public static function last_fetch($_set = false)
	{
		if($_set)
		{
			\lib\db\setting\update::overwirte_cat_key(date("Y-m-d H:i:s"), 'twitter', 'last_fetch');
			return true;
		}

		$load = \lib\db\setting\get::by_cat_key('twitter', 'last_fetch');
		if(isset($load['value']))
		{
			return $load['value'];
		}

		return null;
	}


	public static function get_my_posts($_option = [])
	{
		if(!is_array($_option))
		{
			$_option = [];
		}

		$default_option =
		[
			'type' => 'twitter',
		];

		$option = array_merge($default_option, $_option);

		$get_twitter_posts = \dash\app\posts\search::list(null, $option, true);

		return $get_twitter_posts;

	}


	public static function lookup_tweet($_username, $_tweet_id)
	{
		$args =
		[
			'tweet_id' => $_tweet_id,
			'username' => $_username,
		];

		$save = [];

		$fetch = \lib\api\jibres\api::lookup_tweet($args);

		$save['jibres_api_request_id'] = a($fetch, 'meta', 'jibres_api_request_id');

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

		return $save;
	}



	public static function fetch()
	{
		$twitter_username = \lib\store::social('twitter', true);

		if(!$twitter_username)
		{
			\dash\notif::error(T_("You must first set twitter username in setting"));
			return false;
		}


		$args =
		[
			'username' => $twitter_username,
			'count'    => 1,
		];

		$last_fetch = self::last_fetch();


		$life_time = 60 * 60;

		if(\dash\permission::supervisor())
		{
			$life_time = 60;
		}

		// check last fetch
		if(!$last_fetch || (time() - strtotime($last_fetch) > $life_time)) // need fetch
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("You can fetch latest tweet every 1 hour"));
			return false;

		}

		self::last_fetch(true);

		$tweet_list = \lib\api\jibres\api::get_twitter_tweet_list($args);

		$jibres_api_request_id = a($tweet_list, 'meta', 'jibres_api_request_id');

		if(isset($tweet_list['result']) && $tweet_list['result'] && is_array($tweet_list['result']))
		{

			$user_detail = \lib\app\twitter\extract::user_detail(a($tweet_list, 'result', 'user_detail'));

			$tweets_raw      = a($tweet_list, 'result', 'tweets');

			if(!is_array($tweet_list))
			{
				$tweet_list = [];
			}

			if(!is_array($tweets_raw))
			{
				$tweets_raw = [];
			}

			$tweets = \lib\app\twitter\extract::multi_tweet($tweets_raw);

			$get_one_tweet = true;

			foreach ($tweets as $key => $post_detail)
			{
				if($get_one_tweet && $key > 0)
				{
					break;
				}

				$id   = a($post_detail, 'twid');
				$text = a($post_detail, 'twcontent');

				if(!$id)
				{
					continue;
				}

				$check_duplicate = \lib\db\social_posts\get::by_social_message_id('twitter', $id);

				// add new post
				$add_post_args =
				[

					'cover'            => a($post_detail, 'twthumb'), // path
					'thumb'            => a($post_detail, 'twthumb'), // path
					'title'            => $text ? \dash\text::substr_space($text, 199) : $id,
					'content'          => $text ? $text : $id,
					'type'             => 'twitter',
					'subtype'          => 'standard', // ['enum' => ['standard', 'gallery', 'video', 'audio']],
					'status'           => 'publish', // ['enum' => ['publish','draft', 'pending_review']],
					'is_social_module' => true,
				];

				$insert_socail_posts =
				[
					'social'          => 'twitter',
					'request'         => 'fetch',
					'status'          => null,
					'channel'         => a($user_detail, 'username'),
					'messageid'       => $id,
					'data'            => json_encode(['tweet' => $post_detail, 'user_detail' => $user_detail]),
					'jibresrequestid' => $jibres_api_request_id,
				];

				if(isset($check_duplicate['id']))
				{
					$post_code = \dash\coding::encode($check_duplicate['post_id']);
					if($post_code)
					{
						$edit_post = \dash\app\posts\edit::edit($add_post_args, $post_code);
					}
					$insert_socail_posts['datemodified'] = date("Y-m-d H:i:s");
					\lib\db\social_posts\update::record($insert_socail_posts, $check_duplicate['id']);
				}
				else
				{

					$post_add = \dash\app\posts\add::add($add_post_args);
					if(isset($post_add['post_id']))
					{
						$post_id                        = \dash\coding::decode($post_add['post_id']);
						$insert_socail_posts['post_id'] = $post_id;
						$insert_socail_posts['datecreated'] = date("Y-m-d H:i:s");

						\lib\db\social_posts\insert::new_record($insert_socail_posts);
					}
				}
			}
		}
		\dash\notif::clean();
		\dash\notif::ok(T_("Operation complete"));

	}
}
?>