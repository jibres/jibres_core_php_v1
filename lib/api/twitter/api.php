<?php
namespace lib\api\twitter;

class api
{

	private static $api_url    = 'https://api.twitter.com/2/';

	private static $result_raw = [];

	private static $load_setting = [];


	private static function config()
	{
		if(!self::$load_setting)
		{
			$account = 'jibres.com';
			self::$load_setting = \dash\setting\whisper::say('twitter', $account);
		}
	}


	public static function access_token()
	{
		self::config();
		return a(self::$load_setting, 'access_token');
	}

	public static function access_token_secret()
	{
		self::config();
		return a(self::$load_setting, 'access_token_secret');
	}

	public static function api_key()
	{
		self::config();
		return a(self::$load_setting, 'api_key');
	}

	public static function apikey_secret()
	{
		self::config();
		return a(self::$load_setting, 'apikey_secret');
	}

	public static function bearer()
	{
		self::config();
		return a(self::$load_setting, 'bearer');
	}

	private static function app_id()
	{
		self::config();
		return a(self::$load_setting, 'app_id');
	}



	/**
	 * Run
	 * Connect to facebook
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	private static function run($_args)
	{


		$master_url = self::$api_url;

		if(a($_args, 'url'))
		{
			$master_url .= $_args['url'];
		}

		// get param
		$param = [];
		if(is_array(a($_args, 'param')))
		{
			$param = $_args['param'];
		}

		// body param
		$body = [];
		if(is_array(a($_args, 'body')))
		{
			$body = $_args['body'];
		}

		$method = 'get';
		if(a($_args, 'method'))
		{
			$method = $_args['method'];
		}

		$url = $master_url;

		if($param)
		{
			$url .= '?'. http_build_query($param);
		}

		// set headers
		$header   = [];
		$header[] = 'Accept: application/json';

		if(a($_args, 'bearer'))
		{
			$header[] = "Authorization: Bearer ". self::bearer();
		}


		// send all detail to broker
		$broker_detail =
		[
			'broker_token' => \dash\setting\tunnel_token::get('twitter'),
			'url'          => $url,
			'header'       => $header,
			'body'         => $body,
			'method'       => $method,
		];


		$ch = curl_init();

		// curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://tunnel.jibres.com/twitter/');

		if(\dash\url::isLocal())
		{
			curl_setopt($ch, CURLOPT_URL, 'https://broker.local/twitter/');
		}

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($broker_detail));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);


		$save_log  =
		[
			'store_id'     => \content_r10\tools::get_current_business_id(),
			'identify'     => json_encode(self::$load_setting),
			'request_type' => a($_args, 'url'),
			'user_id'      => null,
			'username'     => null,
			'status'       => 'enable',
			'send'         => json_encode($_args),
			'receive'      => $response,
			'meta'         => null,
			'datecreated'  => date("Y-m-d H:i:s"),
		];

		$jibres_twitter_api_id = \lib\db\twitter\insert::new_record($save_log);

		\dash\notif::meta(['jibres_api_request_id' => 'api:twitter:'. $jibres_twitter_api_id]);

		$log =
		[
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
		];

		\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'twitter.log', 'twitter');


		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to twitter server!"));

			if($CurlError)
			{
				\dash\notif::error(' CURL Error: '. $CurlError);
			}
			return false;
		}

		if(!is_string($response))
		{
			\dash\notif::error('Jibres: Result curl is not string!');
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			\dash\notif::error('Jibres: Can not parse JSON!');
			return addslashes($response);
		}


		return $result;

	}


	private static function user_fields()
	{
		return implode(',', ['created_at','description','entities','id','location','name','pinned_tweet_id','profile_image_url','protected','public_metrics','url','username','verified','withheld']);
	}


	private static function tweet_fields()
	{
		return implode(',', ['context_annotations','attachments','author_id','created_at','id','lang','source','text','withheld']);
	}


	public static function user_lookup($_username)
	{
		$args =
		[
			'method' => 'get',
			'url'    => 'users/by/username/'. $_username,
			'bearer' => true,
			'param'  =>
			[
				'user.fields' => self::user_fields(),
			],
		];

		return self::run($args);
	}


	/**
	 * Not working yet!
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function timelines_by_username($_username, $_args)
	{
		$tweets = [];

		$user_detail =  self::user_lookup($_username);

		if(isset($user_detail['data']['id']))
		{
			$twitter_id = $user_detail['data']['id'];

			$args =
			[
				'method' => 'get',
				'url'    => 'users/'.$twitter_id.'/tweets',
				'bearer' => true,
				'param'  =>
				[
					'max_results'  => 5,
					'tweet.fields' => implode(',' , ['attachments','author_id','context_annotations','conversation_id','created_at','entities','geo','id','in_reply_to_user_id','lang','public_metrics','possibly_sensitive','referenced_tweets','reply_settings','source','text','withheld']),
					'media.fields' => implode(',', ['duration_ms', 'height', 'media_key', 'preview_image_url', 'type', 'url', 'width', 'public_metrics', 'alt_text']),
					'expansions'   => implode(',', ['attachments.media_keys', 'referenced_tweets.id']),
					'exclude'      => 'retweets,replies',
				],
			];

			$tweets =  self::run($args);

			if(!is_array($tweets))
			{
				$tweets = [];
			}

			$tweets = array_reverse($tweets);

		}

		$result = [];
		$result['user_detail'] = $user_detail;
		$result['tweets']      = $tweets;

		return $result;
	}



	public static function lookup_tweet_by_username_id($_username, $_tweet_id)
	{
		$user_detail = self::user_lookup($_username);

		$args =
		[
			'method' => 'get',
			'url'    => 'tweets/'.$_tweet_id,
			'bearer' => true,
			'param'  =>
			[
				'tweet.fields' => implode(',' , ['attachments','author_id','context_annotations','conversation_id','created_at','entities','geo','id','in_reply_to_user_id','lang','public_metrics','possibly_sensitive','referenced_tweets','reply_settings','source','text','withheld']),
				'media.fields' => implode(',', ['duration_ms', 'height', 'media_key', 'preview_image_url', 'type', 'url', 'width', 'public_metrics', 'alt_text']),
				'expansions'   => implode(',', ['attachments.media_keys', 'referenced_tweets.id']),
			],
		];




		$tweet =  self::run($args);

		if(!is_array($tweet))
		{
			$tweet = [];
		}


		$result                = [];
		$result['user_detail'] = $user_detail;
		$result['tweet']       = $tweet;

		return $result;

	}
}
?>