<?php
namespace lib\app\instagram;

class business
{

	/**
	 * Call jibres api to get login url
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function login_url()
	{
		$url = \lib\api\jibres\api::get_instagram_login_url();

		if(!$url || !isset($url['result']['login_url']))
		{
			return false;
		}

		return $url['result']['login_url'];
	}


	public static function remove_token()
	{
		\lib\db\setting\update::overwirte_cat_key(null, 'instagram', 'access_token');
		\lib\db\setting\update::overwirte_cat_key(null, 'instagram', 'user_id');

		\dash\notif::ok(T_("Connection removed"));
		return true;
	}


	public static function access_token()
	{
		$load = \lib\db\setting\get::by_cat_key('instagram', 'access_token');
		if(isset($load['value']))
		{
			return $load['value'];
		}

		return null;
	}

	public static function user_id()
	{
		$load = \lib\db\setting\get::by_cat_key('instagram', 'user_id');
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
			\lib\db\setting\update::overwirte_cat_key(date("Y-m-d H:i:s"), 'instagram', 'last_fetch');
			return true;
		}

		$load = \lib\db\setting\get::by_cat_key('instagram', 'last_fetch');
		if(isset($load['value']))
		{
			return $load['value'];
		}

		return null;
	}


	public static function get_my_posts($_fetch = false)
	{
		if($_fetch)
		{
			$access_token = self::access_token();

			$user_id      = self::user_id();

			if(!$access_token || !$user_id)
			{
				return [];
			}


			$args =
			[
				'access_token' => $access_token,
				'user_id'      => $user_id,
			];

			$last_fetch = self::last_fetch();

			// check last fetch
			if(!$last_fetch || (time() - strtotime($last_fetch) > (60))) // need fetch
			{
				self::last_fetch(true);
				self::fetch($args);
			}
		}

		$get_instagram_posts = \dash\app\posts\search::list(null, ['type' => 'instagram'],true);

		return $get_instagram_posts;

	}


	private static function fetch($_args)
	{
		$media_list = \lib\api\jibres\api::get_instagram_media_list($_args);

		if(isset($media_list['result']) && $media_list['result'] && is_array($media_list['result']))
		{

			$list = $media_list['result'];
			// $list = json_decode('[{"id":"17927571766877861","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.29350-15\/248357558_551925142771794_2221395376912148079_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=ac0k32qBECEAX-E6tih&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=75203740816f31a05f8b9d8f3b761809&oe=619F7DE8","permalink":"https:\/\/www.instagram.com\/p\/CVevC18rssU\/","timestamp":"2021-10-26T05:33:03+0000","username":"rmbiqarar"},{"caption":"\u0634\u0628 \u062a\u062d\u0648\u06cc\u0644 \u067e\u0631\u0648\u0698\u0647... #\u0628\u0646\u0627\u06cc\u06cc #\u0631\u0646\u06af_\u06a9\u0627\u0631\u06cc","id":"18172961989013625","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.29350-15\/127156850_2873188712930092_6319861901236100672_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=VdUit0agYbIAX9q4mBC&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=c4c71a100c5ace7f9c01cd893c125e47&oe=619E61E8","permalink":"https:\/\/www.instagram.com\/p\/CH8X155pUlr\/","timestamp":"2020-11-23T18:28:00+0000","username":"rmbiqarar"},{"caption":"#jibres #love","id":"17847391772082162","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.2885-15\/95257872_1173172869686524_389472800857079012_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=2nWLZXut-I8AX-xi9QU&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=84576d67a080a5f3ad49725d05eefeb5&oe=61A0137D","permalink":"https:\/\/www.instagram.com\/p\/B_qGgJBp5Ej\/","timestamp":"2020-05-01T19:59:00+0000","username":"rmbiqarar"},{"caption":"#jibres #ermile","id":"17885589148495202","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.2885-15\/84317268_2318714528230677_8355062370291717800_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=-UyFfK-kD6gAX8P-5g6&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=a2357caff56d845c4ea56d09b7c57d41&oe=619FD6E8","permalink":"https:\/\/www.instagram.com\/p\/B8j5qnDp125\/","timestamp":"2020-02-14T20:37:12+0000","username":"rmbiqarar"},{"caption":"\u062b\u0628\u062a \u0646\u0627\u0645 \u06a9\u0644\u0627\u0633 \u0647\u0627\u06cc \u0622\u0645\u0648\u0632\u0634 \u0642\u0631\u0622\u0646 \u0648 \u062d\u062f\u06cc\u062b #\u062d\u0631\u0645 \u0645\u0637\u0647\u0631 \u062d\u0636\u0631\u062a \u0641\u0627\u0637\u0645\u0647 \u0645\u0639\u0635\u0648\u0645\u0647 #\u0642\u0645","id":"17859938047223946","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.2885-15\/26226264_349073478906186_7727850302535106560_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=WVqZcrFzKKwAX-QfjfA&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=7bca28595b725ba2788a320b3c720b96&oe=619F65B7","permalink":"https:\/\/www.instagram.com\/p\/BeS2g9XFjoi\/","timestamp":"2018-01-23T14:00:45+0000","username":"rmbiqarar"},{"caption":"#ermile #qom #iran\n#programing #php\n \u06cc\u0647 #\u0686\u0627\u06cc \u062f\u0628\u0634 \u0628\u0639\u062f \u0627\u0632 \u0633\u0627\u0639\u062a \u0647\u0627 #\u0628\u0631\u0646\u0627\u0645\u0647_\u0646\u0648\u06cc\u0633\u06cc","id":"17899408204027336","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.2885-15\/21827719_516885248650897_6053806337001783296_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=QSCudHZhi_4AX9HgSyT&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=7ab46bc2eeca1c69971415f25ea7173e&oe=619EDB3F","permalink":"https:\/\/www.instagram.com\/p\/BZItUhSlS7-\/","timestamp":"2017-09-17T08:51:02+0000","username":"rmbiqarar"},{"caption":"#\u0627\u06cc\u0631\u0627\u0646 #\u0642\u0645 #\u0627\u0631\u0645\u0627\u06cc\u0644 #\u0628\u0631\u0646\u0627\u0645\u0647_\u0646\u0648\u06cc\u0633\u06cc #php #programing","id":"17897848093054349","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.2885-15\/21373581_610432642678209_4785335153977196544_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=6hYQ71XIZz0AX8sbX2K&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=1da6cec241cb8163944794cf6565ceef&oe=619E7273","permalink":"https:\/\/www.instagram.com\/p\/BYyzc8ngHCC\/","timestamp":"2017-09-08T20:41:20+0000","username":"rmbiqarar"},{"caption":"#programming #php #code #ermile \n#\u0628\u0631\u0646\u0627\u0645\u0647_\u0646\u0648\u06cc\u0633\u06cc","id":"17871520675177305","media_type":"IMAGE","media_url":"https:\/\/scontent.cdninstagram.com\/v\/t51.2885-15\/21373290_1715220801823329_562112752626171904_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=ao2u3xP15wsAX-ptkC5&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&oh=2a25fc11cfa20b0dca97616f314246cb&oe=619E961C","permalink":"https:\/\/www.instagram.com\/p\/BYq2gocgVjN\/","timestamp":"2017-09-05T18:34:07+0000","username":"rmbiqarar"}]', true);

			foreach ($list as $key => $post_detail)
			{

				$id         = a($post_detail, 'id');
				$caption    = a($post_detail, 'caption');
				$media_type = a($post_detail, 'media_type');
				$media_url  = a($post_detail, 'media_url');
				$permalink  = a($post_detail, 'permalink');
				$timestamp  = a($post_detail, 'timestamp');
				$username   = a($post_detail, 'username');

				if(!$id)
				{
					continue;
				}

				$check_duplicate = \lib\db\social_posts\get::by_social_message_id('instagram', $id);

				// add new post
				$add_post_args =
				[

					'cover'            => $media_url, // path
					'thumb'            => $media_url, // path
					'title'            => $caption ? substr($caption, 0, 199) : $id,
					'content'          => $caption ? $caption : $id,
					'type'             => 'instagram',
					'subtype'          => 'standard', // ['enum' => ['standard', 'gallery', 'video', 'audio']],
					'status'           => 'publish', // ['enum' => ['publish','draft', 'pending_review']],
					'is_social_module' => true,
				];

				$insert_socail_posts =
				[
					'social'          => 'instagram',
					'request'         => 'fetch',
					'status'          => null,
					'channel'         => $username,
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