<?php
namespace content_a\products\share;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['sharetext'] = isset($_POST['sharetext']) ? $_POST['sharetext'] : null;


		$telegram_setting = \lib\app\setting\get::telegram_setting();
		\dash\data::telegramSetting($telegram_setting);

	    // @javad
	    // $telegram_setting contain:
		// 'apikey' => string 'apikey'
		// 'channel' => string 'channel id'
		// 'share_text' => string 'default share text'

		$apikey   = $telegram_setting['apikey'];
		// $botname   = $telegram_setting['botUserName'];
		$botname   = 'testbot';
		$chatid   = '@'. $telegram_setting['channel'];
		// $chatid   = 46898544;

		$photo    = \dash\data::productDataRow_thumb();
		$text     = '<b>'. \dash\data::productDataRow_title(). '</b>';
		$text     .= "\n";
		$text     .= \dash\data::productDataRow_sharetext();
		$text     .= "\n\n";
		$text     .= $telegram_setting['share_text'];


		$myData   = ['chat_id' => $chatid, 'text' => $text, 'reply_markup' => false];
		\dash\social\telegram\tg::$api_token = $apikey;
		\dash\social\telegram\tg::$name = $botname;

		if($photo)
		{
			$myData['photo'] = $photo;
			$myResult = \dash\social\telegram\tg::sendPhoto($myData);
		}
		else
		{
			$myResult = \dash\social\telegram\tg::sendMessage($myData);

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

		var_dump($myResult);


		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>