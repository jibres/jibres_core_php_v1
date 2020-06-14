<?php
namespace content_a\products\comment\answer;

class model
{
	public static function post()
	{
		$answer = \dash\request::post('answer');

		if(!$answer)
		{
			\dash\notif::error(T_("Please fill the answer box"));
			return false;
		}

		$post_detail = \lib\app\product\comment::answer($answer, \dash\request::get('cid'));

		if(\dash\engine\process::status())
		{
			\dash\log::set('answerProductComment', ['code' => \dash\request::get('cid')]);

			\dash\redirect::pwd();
		}
	}
}
?>
