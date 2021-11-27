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


		// $tweet_list = ['result' => json_decode('{"user_detail":{"data":{"username":"RmBiqarar","profile_image_url":"https://pbs.twimg.com/profile_images/1218021289094459393/sxygwdzM_normal.jpg","url":"https://t.co/Sx1vWdIbGa","protected":false,"verified":false,"id":"902618762","created_at":"2012-10-24T21:12:28.000Z","public_metrics":{"followers_count":67,"following_count":359,"tweet_count":57,"listed_count":0},"name":"Reza Mohiti","description":"Developer","location":"Qom","entities":{"url":{"urls":[{"start":0,"end":23,"url":"https://t.co/Sx1vWdIbGa","expanded_url":"http://rezamohiti.ir","display_url":"rezamohiti.ir"}]}}}},"tweets":{"data":[{"id":"1452870345258586113","lang":"fa","created_at":"2021-10-26T05:30:57.000Z","attachments":{"media_keys":["3_1452870202769743879"]},"text":"RT @rafiei_naser: بانویِ مهربانِ جهان اشفعی لنا https://t.co/XZf72cpwGc","source":"Twitter for iPhone","author_id":"902618762"},{"id":"1449043197859188745","lang":"fa","created_at":"2021-10-15T16:03:14.000Z","text":"@ahmadkarimi1991 جیبرس","source":"Twitter for iPhone","author_id":"902618762"},{"id":"1432344697712914432","lang":"fa","created_at":"2021-08-30T14:09:22.000Z","text":"@MrAdib عزت زیاد","source":"Twitter Web App","author_id":"902618762"},{"id":"1430543738309386250","lang":"fa","created_at":"2021-08-25T14:53:00.000Z","text":"RT @Amir_forughi: التماس میکنم\n\nشب ها آب نمک غرغره کنید،بخوابید\nشب ها آب نمک غرغره کنید،بخوابید\nشب ها آب نمک غرغره کنید،بخوابید\nشب ها آب نم…","source":"Twitter Web App","author_id":"902618762"},{"id":"1425406060878340102","lang":"fa","created_at":"2021-08-11T10:37:42.000Z","text":"@voorivex توی php8 این مورد حل شده","source":"Twitter Web App","author_id":"902618762"},{"id":"1405483531132940290","lang":"fa","created_at":"2021-06-17T11:12:41.000Z","text":"@ahmadkarimi1991 عالی. من احساس میکنم همشو دارم.","source":"Twitter for iPhone","author_id":"902618762"},{"id":"1402264266879770630","lang":"fa","created_at":"2021-06-08T14:00:28.000Z","text":"@AbouHatef رفته بودی پارک آب بازی کنی؟؟ 😉","source":"Twitter for iPhone","author_id":"902618762"},{"id":"1401581349333504008","lang":"fa","created_at":"2021-06-06T16:46:48.000Z","text":"@ahmadkarimi1991 بستگی داره","source":"Twitter for iPhone","author_id":"902618762"},{"id":"1401188202724139008","lang":"fa","created_at":"2021-06-05T14:44:35.000Z","text":"@MotherOfLights به مردش + شغلش","source":"Twitter for iPhone","author_id":"902618762"},{"id":"1401187200637751297","lang":"fa","created_at":"2021-06-05T14:40:36.000Z","text":"@MotherOfLights بستگی داره","source":"Twitter for iPhone","author_id":"902618762"}],"meta":{"oldest_id":"1401187200637751297","newest_id":"1452870345258586113","result_count":10,"next_token":"7140dibdnow9c7btw3z0rpjvptolrdle9xgy4hh2ywnjr"}}}', true)];

		if(isset($tweet_list['result']) && $tweet_list['result'] && is_array($tweet_list['result']))
		{

			$user_detail = a($tweet_list, 'result', 'user_detail', 'data');
			$tweets      = a($tweet_list, 'result', 'tweets', 'data');

			if(!is_array($tweet_list))
			{
				$tweet_list = [];
			}

			if(!is_array($tweets))
			{
				$tweets = [];
			}



			foreach ($tweets as $key => $post_detail)
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