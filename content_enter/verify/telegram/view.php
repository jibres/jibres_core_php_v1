<?php
namespace content_enter\verify\telegram;


class view
{
	public static function config()
	{

		\content_enter\verify\view::verifyPageTitle();

		list($my_chat_id, $user_id) = model::detect_user_chat_id();

		if($my_chat_id)
		{
			if(!\dash\utility\enter::get_session('run_telegram_to_user'))
			{
				\dash\utility\enter::set_session('run_telegram_to_user', true);
				\content_enter\verify\telegram\model::send_telegram_code();
			}
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/tg');
		}

	}
}
?>