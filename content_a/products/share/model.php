<?php
namespace content_a\products\share;
// use telegram class as bot
use \dash\social\telegram\tg as bot;

class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['sharetext'] = isset($_POST['sharetext']) ? $_POST['sharetext'] : null;

		\lib\app\product\edit::edit($post, $id);
		\dash\notif::clean();

		\lib\db\products\get::$catch_load_one_product = [];
		\lib\app\product\load::one($id);



		$telegram_setting = \lib\app\setting\get::telegram_setting();
		\dash\data::telegramSetting($telegram_setting);

	    // @javad
	    // $telegram_setting contain:
		// 'apikey' => string 'apikey'
		// 'channel' => string 'channel id'
		// 'share_text' => string 'default share text'

		if(!\dash\data::telegramSetting_apikey())
		{
			\dash\notif::error(T_("You must set your telegram apikey first in bussiness setting"));
			return false;
		}

		if(!\dash\data::telegramSetting_channel())
		{
			\dash\notif::error(T_("You must set your telegram channel first in bussiness setting"));
			return false;
		}
		$msgData  = [];
		$msgData['chat_id'] = '@'. $telegram_setting['channel'];
		// $botname   = $telegram_setting['botUserName'];
		$botname   = 'testbot';

		// set photo of product
		if(\dash\data::productDataRow_thumb())
		{
			$msgData['photo'] = \dash\data::productDataRow_thumb();
		}

		// title
		$txt = '<b>'. \dash\data::productDataRow_title(). '</b>'. "\n";
		if(\dash\data::productDataRow_title2())
		{
			$txt .= \dash\data::productDataRow_title2(). "\n";
		}
		// price
		$txt .= T_("Price");
		$txt .= ' <code>'. \dash\fit::price(\dash\data::productDataRow_finalprice(), true). '</code> ';
		$txt .= \lib\currency::unit(). "\n\n";

		// product share text
		if(\dash\data::productDataRow_sharetext())
		{
			$txt     .= \dash\data::productDataRow_sharetext(). "\n";
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
				'url'  => \lib\store::url(). '/p/'. \dash\data::productDataRow_id(),
			],
		];


		$telegrambtn = \dash\get::index(\dash\data::telegramSetting(), 'telegrambtn');

		if(empty($social) || !$telegrambtn)
		{
		// nothing
		}
		else
		{
			foreach ($social as $key => $value)
			{
				if(\dash\get::index($social, $key) && \dash\get::index($telegrambtn, $key))
				{
					$reply_markup[] =
					[
						'text' => \dash\get::index($value, 'title'),
						'url'  => \dash\get::index($social, $key, 'link'),
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
						'text' => T_("Register a new order"),
						'url'  => \lib\store::url(),
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




		bot::$api_token = $telegram_setting['apikey'];
		bot::$name      = $botname;
		if(isset($msgData['photo']))
		{
			$msgData['caption'] = $txt;
			$myResult = bot::sendPhoto($msgData);
		}
		else
		{
			$msgData['text'] = $txt;
			$myResult = bot::sendMessage($msgData);

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