<?php
namespace content_cms\comments\view;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\dash\app\comment\remove::remove(\dash\request::get('cid'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}

			return;
		}


		if(\dash\request::post('answertocomment') === 'answertocomment')
		{
			$answer            = [];
			$answer['content'] = \dash\request::post('answer');
			$answer['title']   = \dash\request::post('answertitle');


			\dash\app\comment\add::answer($answer, \dash\request::get('cid'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}


		if(\dash\request::post('status'))
		{

			$status      = \dash\request::post('status');

			$post_detail = \dash\app\comment\edit::edit_status($status, \dash\request::get('cid'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
