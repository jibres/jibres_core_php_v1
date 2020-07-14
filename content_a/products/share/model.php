<?php
namespace content_a\products\share;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['sharetext'] = isset($_POST['sharetext']) ? $_POST['sharetext'] : null;


		$chatid   = 46898544;
		$text     = 'salam';
		$myData   = ['chat_id' => $chatid, 'text' => $text];
		$myResult = \dash\social\telegram\tg::json_sendMessage($myData);

		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>