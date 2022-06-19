<?php
namespace content_a\form\answer\note;


class model
{
	public static function post()
	{

		$note_id = \dash\request::get('noteid');

		$post = [];

		$post['content'] = \dash\request::post('comment');
		$post['color']   = \dash\request::post('color');
		$post['privacy'] = \dash\request::post('privacy');
		$post['date']    = \dash\request::post('date');
		$post['time']    = \dash\request::post('time');

		if(\dash\request::files('file'))
		{
			$post['file'] = 1;
		}

		\lib\app\form\comment\edit::edit($post, $note_id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/detail'.\dash\request::full_get());
			return;
		}

		if(\dash\request::post('removecomment') === 'removecomment')
		{
			$id = \dash\request::post('id');
			\lib\app\form\comment\remove::remove($id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/detail'.\dash\request::full_get(['noteid' => null]));
				return;
			}
		}


	}

}
?>
