<?php
namespace content_store\creating;


class model
{
	public static function post()
	{
		if(\dash\request::post('create') === 'store')
		{
			$title           = \dash\session::get('createNewStore_title', 'CreateNewStore');
			$subdomain       = \dash\session::get('createNewStore_subdomain', 'CreateNewStore');
			$question_answer = \dash\session::get('createNewStore_question_answer', 'CreateNewStore');

			$post =
			[
				'title'     => $title,
				'subdomain' => $subdomain,
				'answer'    => $question_answer,
			];

			\lib\app\store\add::trial($post);

			if(\dash\engine\process::status())
			{
				\dash\session::clean_cat('CreateNewStore');
				\dash\session::set('myNewStoreId', $subdomain);
				\dash\notif::direct();
				\dash\redirect::to(\dash\url::here().'/opening');
			}
			else
			{
				return false;
			}
		}
	}
}
?>
