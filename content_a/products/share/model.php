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
		$chatid   = $telegram_setting['channel'];
		$chatid   = 46898544;

		$photo    = \dash\data::productDataRow_thumb();
		$text     = '<b>'. \dash\data::productDataRow_title(). '</b>';
		$text     .= "\n";
		$text     .= \dash\data::productDataRow_sharetext();
		$text     .= "\n\n";
		$text     .= $telegram_setting['share_text'];


		$myData   = ['chat_id' => $chatid, 'text' => $text];
		$myResult = \dash\social\telegram\tg::json_sendMessage($myData);

		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>