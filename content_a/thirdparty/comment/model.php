<?php
namespace content_a\thirdparty\comment;


class model
{
	public static function getPost()
	{
		$post         = [];
		$post['note'] = \dash\request::post('note');

		return $post;
	}


	public static function post()
	{
		if(!\dash\request::post('note'))
		{
			\dash\notif::error(T_("Please fill the note box"), 'note');
			return false;
		}

		\dash\permission::access('thirdpartyNoteAdd');

		\lib\app\thirdparty\comment::add(\dash\request::post('note'), \dash\request::get('id'));

		if(\dash\request::post('redirecturl'))
		{
			\dash\redirect::to($_POST['redirecturl']);
		}
	}
}
?>
