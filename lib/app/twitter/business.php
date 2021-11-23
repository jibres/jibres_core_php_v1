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


	public static function get_my_posts($_fetch = false)
	{
		$twitter_username = \lib\store::social('twitter', true);

		if($_fetch)
		{
			if(!$twitter_username)
			{
				if($_fetch)
				{
					\dash\notif::error(T_("Twitter username not set!"));
				}
				return [];
			}


			$args =
			[
				'username' => $twitter_username,
				'user_id'  => self::user_id(),
				'count'    => 5,
			];

			$last_fetch = self::last_fetch();

			// check last fetch
			if(!$last_fetch || (time() - strtotime($last_fetch) > (60))) // need fetch
			{
				self::last_fetch(true);
				self::fetch($args);
			}
		}

		$get_twitter_posts = \dash\app\posts\search::list(null, ['type' => 'twitter'], true);

		return $get_twitter_posts;

	}



	private static function fetch($_args)
	{
		$tweet_list = \lib\api\jibres\api::get_twitter_tweet_list($_args);


		if(isset($tweet_list['result']) && $tweet_list['result'] && is_array($tweet_list['result']))
		{

			$list = $tweet_list['result'];

			foreach ($list as $key => $post_detail)
			{

				$id   = a($post_detail, 'id');
				$text = a($post_detail, 'text');

				if(!$id)
				{
					continue;
				}

				$check_duplicate = \lib\db\social_posts\get::by_social_message_id('twitter', $id);

				// add new post
				$add_post_args =
				[

					// 'cover'            => $media_url, // path
					// 'thumb'            => $media_url, // path
					'title'            => $text ? substr($text, 0, 199) : $id,
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
					// 'channel'         => $username,
					'messageid'       => $id,
					'data'            => json_encode($post_detail),
					'jibresrequestid' => null,
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

	}
}
?>