<?php
namespace content_store\subdomain;


class model
{
	public static function getPost()
	{
		$post              = [];
		$post['title']     = \dash\request::post('title');
		$post['subdomain'] = \dash\request::post('subdomain');
  		return $post;
	}


	public static function post()
	{
		$title           = \dash\session::get('createNewStore_title');
		$question_answer = \dash\session::get('createNewStore_question_answer');
		$subdomain       = \dash\request::post('sd');

		$post =
		[
			'title'     => $title,
			'subdomain' => $subdomain,
			'answer'    => $question_answer,
		];

		\lib\app\store\add::trial($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::ok(T_("Your store successfully created"), ['alerty' => true, 'timeout' => 5000]);
			\dash\session::set('createNewStore_title', null);
			\dash\session::set('createNewStore_question_answer', null);
			\dash\redirect::to(\dash\url::here());
		}
	}
}
?>
