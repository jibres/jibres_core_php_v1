<?php
namespace dash\app\telegram;


class post
{
	public static function send($_id, $_meta = [])
	{

		$post_detail = \dash\app\posts\get::load_post($_id);

		if(!$post_detail)
		{
			return false;
		}

		$telegram_setting = \lib\app\setting\get::telegram_setting();


		if(!a($telegram_setting, 'apikey'))
		{
			\dash\notif::error(T_("You must set your telegram apikey first in bussiness setting"));
			return false;
		}

		if(!a($telegram_setting, 'channel'))
		{
			\dash\notif::error(T_("You must set your telegram channel first in bussiness setting"));
			return false;
		}

		$msgData  = [];
		$msgData['post_id'] = \dash\coding::decode($_id);
		$msgData['chat_id'] = '@'. $telegram_setting['channel'];

		$botname   = a($telegram_setting, 'username');
		// $botname   = 'testbot';

		// set photo of product
		if(a($post_detail , 'thumb'))
		{
			$msgData['photo'] = a($post_detail , 'thumb');
		}


		$txt = '<b>'. a($post_detail , 'title'). '</b>'. "\n";

		if(a($post_detail , 'excerpt'))
		{
			$txt     .= a($post_detail , 'excerpt'). "\n";
		}

		if(a($_meta , 'sharetext'))
		{
			$txt     .= a($_meta , 'sharetext'). "\n";
		}

		if(isset($post_detail['tags']))
		{
			$txt .= "\n". self::get_tags_html($post_detail['tags']). "\n";
		}

		if(isset($telegram_setting['share_text']))
		{
			$txt     .= "\n". $telegram_setting['share_text'];
		}


//		$msgData['reply_markup'] = false;

		$social = \lib\store::social();

		$reply_markup = [];

        $telegrambtn = a($telegram_setting, 'telegrambtn');

		if(empty($social) || !$telegrambtn)
		{
		// nothing
		}
		else
		{
			foreach ($social as $key => $value)
			{
				if(a($social, $key) && a($telegrambtn, $key))
				{
					$reply_markup[] =
					[
						'text' => a($value, 'title'),
						'url'  => a($social, $key, 'link'),
					];
				}
			}
		}


		if(!empty($reply_markup))
		{
			$msgData['reply_markup'] =
			[
				'inline_keyboard' =>
				[
					[
						[
							'text' => T_("View"),
							'url'  => \lib\store::url(). '/n/'. a($post_detail , 'id'),
						],
					],

					$reply_markup,

					// [
					// 	[
					// 		'text'          => T_("Online Shopping"),
					// 		'callback_data' => 'ticket',
					// 	],
					// ]
				],
			];
		}
		else
		{
			$msgData['reply_markup'] =
			[
				'inline_keyboard' =>
				[
					[
						[
							'text' => T_("View"),
							'url'  => \lib\store::url(). '/n/'. a($post_detail , 'id'),
						],
					],

					// [
					// 	[
					// 		'text'          => T_("Online Shopping"),
					// 		'callback_data' => 'ticket',
					// 	],
					// ]
				],
			];
		}


		\dash\social\telegram\tg::$api_token = $telegram_setting['apikey'];
		\dash\social\telegram\tg::$name      = $botname;
		if(isset($msgData['photo']))
		{
			$msgData['caption'] = $txt;
			$myResult = \dash\social\telegram\tg::sendPhoto($msgData);
		}
		else
		{
			$msgData['text'] = $txt;
			$myResult = \dash\social\telegram\tg::sendMessage($msgData);
		}



        if(isset($myResult['error_code']) && $myResult['error_code'] && isset($myResult['description']))
        {
            \dash\log::set('ProductErrorrSendTelegram', ['tgResult' => $myResult]);
            \dash\notif::error(T_("Can not send this post to telegram"), ['description' => $myResult['description']]);
        }
        else
        {
            \dash\notif::ok(T_("Post successfully on telegram"));
            return true;
        }
		// if bot user is not exist in chat
		// description: "Bad Request: chat not found"
		// error_code: 400
		// ok: false


		// error 2
		// description: "Bad Request: inline keyboard expected"
		// error_code: 400
		// ok: false

		// error 3 - send photo without photo
		// description: "Bad Request: there is no photo in the request"
		// error_code: 400
		// ok: false


		// error 4 - photo with invalid url
		// description: "Bad Request: wrong file identifier/HTTP URL specified"
		// error_code: 400
		// ok: false


	}



	public static function get_tags_html($_tags)
	{
		if(!$_tags || !is_array($_tags))
		{
			return null;
		}

		$result = '';
		foreach ($_tags as $key => $value)
		{
			if(isset($value['title']))
			{
				$result .= ' #'. str_replace(' ', '_', $value['title']);
			}
		}

		return $result;
	}
}
?>