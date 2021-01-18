<?php
namespace dash\app\telegram;


class post
{
	public static function send($_id, $_meta = [])
	{

		$post_detail = \dash\app\posts\get::get($_id);

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
		$msgData['chat_id'] = '@'. $telegram_setting['channel'];

		$botname   = a($telegram_setting, 'username');
		// $botname   = 'testbot';

		// set photo of product
		if(a($post_detail , 'thumb'))
		{
			$msgData['photo'] = a($post_detail , 'thumb');
		}

		// title
		$txt = '<b>'. a($post_detail , 'title'). '</b>'. "\n";

		// product share text
		if(a($post_detail , 'excerpt'))
		{
			$txt     .= a($post_detail , 'excerpt'). "\n";
		}

		// bussiness tg text footer
		if(isset($telegram_setting['share_text']))
		{
			$txt     .= "\n". $telegram_setting['share_text'];
		}

		$msgData['reply_markup'] = false;

		$social = \lib\store::social();

		$reply_markup =
		[
			[
				'text' => T_("Website"),
				'url'  => \lib\store::url(),
			],
		];


		$telegrambtn = a(\dash\data::telegramSetting(), 'telegrambtn');

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



		$msgData['reply_markup'] =
		[
			'inline_keyboard' =>
			[
				[
					[
						'text' => T_("View order"),
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





		\dash\social\telegram\tg::$api_token = $telegram_setting['apikey'];
		\dash\social\telegram\tg::$name      = $botname;
		// if(isset($msgData['photo']))
		// {
		// 	$msgData['caption'] = $txt;
		// 	// $myResult = \dash\social\telegram\tg::sendPhoto($msgData);
		// }
		// else
		{
			$msgData['text'] = $txt;
			$myResult = \dash\social\telegram\tg::sendMessage($msgData);

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
		\dash\notif::ok(T_("Post successfully on telegram"));
		return true;

	}
}
?>