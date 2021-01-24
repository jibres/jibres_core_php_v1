<?php
namespace content_crm\ticket\view;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');


		if(\dash\request::post('newbranch') && \dash\request::post('branch'))
		{
			$result = \dash\app\ticket\add::branch($id, \dash\request::post('branch'));

			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
			}

			return true;
		}


		$post =
		[
			'content'     => \dash\request::post_raw('answer'),
			'sendmessage' => \dash\request::post('sendmessage'),
			'note'        => \dash\request::post('note'),
		];

		\dash\app\ticket\answer::add($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
