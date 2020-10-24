<?php
namespace content_a\form\answer\detail;


class model
{
	public static function post()
	{

		$answer_id = \dash\request::get('aid');
		if(\dash\request::post('addtag') === 'addtag')
		{
			\lib\app\form\tag\add::answer_add(\dash\request::post('tag'), $answer_id, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Tag saved"));
			}
		}


		if(\dash\request::post('formcomment') === 'formcomment')
		{
			$post = [];

			$post['comment']   = \dash\request::post('comment');
			$post['privacy']   = \dash\request::post('privacy');
			$post['form_id']   = \dash\request::get('id');
			$post['answer_id'] = \dash\request::get('aid');

			if(\dash\request::files('file'))
			{
				$post['file'] = 1;
			}

			\lib\app\form\comment\add::add($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

		}

		if(\dash\request::post('remove') === 'answer')
		{
			$answer_id = \dash\request::post('id');
			if($answer_id)
			{
				\lib\app\form\answer\remove::remove($answer_id);
				\dash\notif::ok(T_("Answer removed"));
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
		}

	}

}
?>
