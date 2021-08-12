<?php
namespace content_sudo\tg\sendphoto;

class model
{
	public static function post()
	{
		$chatid = \dash\request::post('chatid');
		$text   = \dash\request::post('text');

		$myFile = \dash\upload\file::upload('file2');
		if(!$myFile)
		{
			$myFile = \dash\request::post('file1');
		}
		else
		{
			$myFile = isset($myFile['path']) ? $myFile['path'] : null;
		}

		if(!$myFile)
		{
			\dash\notif::error(T_('Please add url or choose file'));
			return false;
		}


		$myData   = ['chat_id' => $chatid, 'photo' => $myFile, 'caption' => $text];
		$myResult = \dash\social\telegram\tg::json_sendPhoto($myData);
		\dash\log::set('tgSendPhoto', ['chatid' => $chatid]);
		\dash\session::set('tg_send', json_encode($myData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
		\dash\session::set('tg_response', $myResult);

		\dash\redirect::pwd();
	}
}
?>